<?php

namespace App\Http\Controllers\Admin;
use App\Http\Traits\Media;
use Input ;
use Storage ;
use Redirect ;

class MediaController extends AdminController
{
 
  use Media ;
   
  /**
   * Upload a file
   *
   * @param string $dir
   * @param string $id
   * 
   * @return none
   */
  public function uploadImages( $dir, $id )
  {
    $file = Input::file('file'); 
    Storage::disk('public')->put(
      'images/'.$dir.'/'.$id.'/'.basename($file->getClientOriginalName()),
      file_get_contents($file)
    );
  }
  
  /**
   * Return Thumbnails
   *
   * @param string $id
   * @param string $type
   * @param string $model
   * 
   * @return Response
   */
  public function getThumbnails( $id, $model='products', $type='images' )
  {
    $files = $this->getFiles($type.'/'.$model.'/'.$id);
    $class = 'App\\Models\\'.str_singular(ucfirst($model)) ;
    $item = $class::find($id) ;
    return view('admin/media/thumbs', ['files' => $files, 'item' => $item, 'id' => $id, 'model' => str_singular($model)]);
  }
  
  /**
   * delete a file
   * 
   * @return Redirect
   */
  public function delete()
  {
    $file = Input::get('file'); 
    Storage::disk('public')->delete( $file ) ;
    return Redirect::back() ;
  }
  
  /**
   * make file default
   * 
   * @return Redirect
   */
  public function default( $id, $type='product')
  {
    $file = Input::get('file');
    $model = 'App\\Models\\'.ucfirst($type) ;
    $item = $model::find($id) ; 
    $item->defaultImage = $file ;
    $item->save() ;
    Return Redirect::back() ;
  }
}