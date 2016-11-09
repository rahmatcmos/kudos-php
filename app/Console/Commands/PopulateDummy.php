<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
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
      
      // create 3 sets of options
      
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
          $product->slug = 'product-'.$x.'category-'.$i;
          $product->categories = [$category->id];
          $product->price = number_format(rand(50, 275),2);
          $product->rrp = number_format($product->price * 1.2, 2);
          $product->salePrice = number_format($product->price * 0.8, 2);
          foreach($langs as $code => $lang){
            $data = [
              'name' => $$lang->name.' '.$i,
              'content' => $lorem->sentence($nbWords = 200, $variableNbWords = true),
              'excerpt' => $lorem->sentence($nbWords = 50, $variableNbWords = true)
            ] ;
            $category->$code = $data ;
          }
          $product->default = $data ;  
          
          // save random options to each product, 3 of each?
              
          $product->save();
          $categoryProducts[] = $product->id ;
          app('App\Http\Controllers\Admin\MediaController')->generateImages( 'products', $product->id, 'http://unsplash.it/1600/900/?random' ) ;    
          $product->defaultImage = 'images/products/'.$product->id.'/large/image'.$product->id.'.jpg';    
          $product->save();
        }
        $category->products = $categoryProducts ;
        $category->save();
      }
    }
}
