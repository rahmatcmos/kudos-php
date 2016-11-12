<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionProduct;
use App\Models\OptionProductValue;
use App\Http\Traits\Media;
use Faker ;

class PopulateDummy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:dummy {shop} {categories} {products}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate a shop with dummy data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      set_time_limit(0);
      ignore_user_abort(1);
      
      $english = Faker\Factory::create('en_GB');
      $french = Faker\Factory::create('fr_FR');
      $chinese = Faker\Factory::create('zh_CN');
      $german = Faker\Factory::create('de_DE');
      $spanish = Faker\Factory::create('es_ES');
      $lorem = new Faker\Provider\Lorem($english) ;
      
      $langs = [
        'fr' => 'french',
        'cn' => 'chinese',
        'de' => 'german',
        'es' => 'spanish',
        'en' => 'english'
      ];
      
      $shopId = $this->argument('shop');
      $categories = (integer) $this->argument('categories') + 1;
      $products = (integer) $this->argument('products') + 1;
      
      // create 3 sets of options for color,size & material
      $data = [
        'Color' => ['Red', 'Green', 'Blue','Orange', 'Purple', 'Yellow'],
        'Material' => ['Canvas', 'Glossy', 'Matt'],
        'Size' => ['Xlarge', 'Large', 'Medium', 'Small', 'Xsmall'],
      ] ;
      
      // build and create option
      foreach($data as $key => $options){
        $currentOptions = [] ;
        foreach($langs as $lang => $label){
          $currentOptions[$lang][$key] = $options ;
        }
        $currentOptions['default'] = $currentOptions[$lang] ;
        $option = Option::create($currentOptions);
      }
      
      for($i=1;$i<$categories;$i++){
        // create a category;
        $categoryProducts = [] ;
        $category = new Category;
        $category->shop_id = $shopId;
        $category->parent = 0;
        $category->slug = 'category-'.$i;
        $category->products = []; 
        foreach($langs as $code => $lang){
          $data = [
            'name' => $$lang->name.' '.$i,
            'content' => $lorem->sentence($nbWords = 6, $variableNbWords = true)
          ] ;
          $category->$code = $data ;
        }
        $category->default = $data ;
        $category->save();
         
        // create products
        for($x=1;$x<$products;$x++){
          // store
          $product = new Product;
          $product->shop_id = $shopId;
          $product->slug = 'product-'.$x.'-category-'.$i;
          $product->sku = 'product-'.$x.'-category-'.$i;
          $product->categories = [$category->id];
          $product->price = number_format(rand(50, 275),2);
          $product->rrp = number_format($product->price * 1.2, 2);
          $product->salePrice = number_format($product->price * 0.8, 2);
          foreach($langs as $code => $lang){
            $data = [
              'name' => $$lang->name,
              'content' => $lorem->sentence($nbWords = 200, $variableNbWords = true),
              'excerpt' => $lorem->sentence($nbWords = 50, $variableNbWords = true)
            ] ;
            $product->$code = $data ;
          }
          $product->default = $data ;  
          
          // save the product
          $product->save();
          
          // register product with each new option
          $options = Option::all() ;
          $newOptions = $toadd = [] ;
          foreach($options as $option){
            $optionProduct = OptionProduct::firstOrNew(['option_id' => $option->id]);
            $optionProduct->option_id = $option->id;
            $optionProduct_products = isset($optionProduct->products ) ? $optionProduct->products : [] ;
            array_push($optionProduct_products, $product->id) ; 
            $optionProduct->products = $optionProduct_products; 
            $optionProduct->save() ;
            // register option with this product
            $productOptions = isset($product->options) ? $product->options : [] ;
            array_push($productOptions, $option->id) ; 
            $product->options = $productOptions ;
            $product->option_values = [] ;
            $option_default = $option->default ;
            $toadd[$option->id] = reset($option_default) ;
            $product->save() ;
          }
          
          // we have the options lets add to the product
          $combo = [] ;
          for($z=0;$z<3;$z++){
            foreach($toadd as $key => $value){
              $combo[$z][$key] = array_rand($value, 1) ;
            }
          }
          $combo = array_map("unserialize", array_unique(array_map("serialize", $combo)));
          
          //$newOptions[$option->id][] = array_rand(reset($toadd), 1);
          $count = 0 ;
          foreach($combo as $c){
            $productOptionValues = $product->option_values ;
            $new = [
              'sku' => $product->sku.'_'.$count++,
              'price' => $product->price,
              'options' => $c
            ] ;
            $productOptionValues[] = $new ;
            $product->option_values = $productOptionValues ;
            $product->save() ;
          }
          
          // add this option to OPV table for quick filtering
          $povs = $product->option_values ;
          foreach($povs as $pov){
            foreach($pov['options'] as $keyz => $optionz){
              $opv = OptionProductValue::where('filter', $keyz.'-'.$optionz)->first() ;
              if(!$opv){
                // insert first
                OptionProductValue::create([
                  'filter' => $keyz.'-'.$optionz,
                  'products' => [$product->id]
                ]) ;
              } else {
                // add to list
                $p = $opv->products ;
                array_push($p, $product->id) ;
                $opv->products = array_unique($p) ;
                $opv->save();
              }
            }
          }
          
          // add images
          $categoryProducts[] = $product->id ;
          app('App\Http\Controllers\Admin\MediaController')->generateImages( 'products', $product->id, 'http://lorempixel.com/1600/900/' ) ;    
          $product->defaultImage = 'images/products/'.$product->id.'/large/image'.$product->id.'.jpg';    
          $product->save();
        }
        $category->products = $categoryProducts ;
        $category->save();
      }
    }
}
