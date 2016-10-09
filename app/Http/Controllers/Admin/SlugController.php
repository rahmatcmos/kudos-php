<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class SlugController extends AdminController
{  
    /**
     * get a safe slug
     *
     * @return String
     */
    public function slugify(Request $request)
    {
      $slug = $this->generate(str_slug($request->slug)) ;
      return $slug ; 
    }
    
    /**
     * generate slug and check each of the tables
     *
     * @return String
     */
    public function generate($slug, $append=1){
      $count = 0 ;
      foreach(['Category', 'Product', 'Blog', 'Page'] as $table){
        $model = "\\App\\Models\\".$table ;
        $count += $model::where('slug', $slug)->count();
      }
      if($count>0){
        $slug = $this->generate($slug.$append, $append++) ;
      }
      return $slug ;
    }
}