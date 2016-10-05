<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Traits\Media;
use Storage ;
use Image ; 

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
  public function uploadImages(Request $request, $dir, $id )
  {
    $file = $request->file('file'); 

    Storage::disk('public')->put(
      'images/'.$dir.'/'.$id.'/'.basename($file->getClientOriginalName()),
      file_get_contents($file)
    );

    // resizing
    foreach(config('image.image_sizes') as $name => $size){
      $thumb = Image::make($request->file('file'))->resize($size[0], null, function ($constraint) {
        $constraint->aspectRatio();
      });
      if($thumb->height()>$size[1]){
        $offset = floor(($thumb->height()-$size[1])/2);
        $thumb->crop( $size[0], $size[1], 0, $offset) ;
      }
      $thumb->stream() ;
      Storage::disk('public')->put(
        'images/'.$dir.'/'.$id.'/'.$name.'/'.basename($file->getClientOriginalName()),
        $thumb->__toString()
      ) ;
    }
  }
  
  /**
   * Generate a random image
   *
   * @param string $dir
   * @param string $id
   * 
   * @return none
   */
  public function generateImages( $dir, $id, $file )
  {
    $file = Image::make($file);

    Storage::disk('public')->put(
      'images/'.$dir.'/'.$id.'/image'.$id.'.jpg',
      $file->stream()
    );

    // resizing
    foreach(config('image.image_sizes') as $name => $size){
      $thumb = $file->resize($size[0], null, function ($constraint) {
        $constraint->aspectRatio();
      });
      if($thumb->height()>$size[1]){
        $offset = floor(($thumb->height()-$size[1])/2);
        $thumb->crop( $size[0], $size[1], 0, $offset) ;
      }
      Storage::disk('public')->put(
        'images/'.$dir.'/'.$id.'/'.$name.'/image'.$id.'.jpg',
        $thumb->stream()
      ) ;
    }
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
    $file_size = key(config('image.image_sizes')) ;
    $files = $this->getFiles($type.'/'.$model.'/'.$id.'/'.$file_size);
    $class = 'App\\Models\\'.str_singular(ucfirst($model)) ;
    $item = $class::find($id) ;
    return view('admin/media/thumbs', ['files' => $files, 'item' => $item, 'id' => $id, 'model' => str_singular($model), 'file_size' => $file_size]);
  }
  
  /**
   * delete a file
   * 
   * @return Redirect
   */
  public function delete(Request $request)
  {
    $file = $request->get('file'); 
    Storage::disk('public')->delete( $file ) ;
    
    // resized images
    $path_parts = pathinfo($file);
    foreach(config('image.image_sizes') as $name => $size){
      Storage::disk('public')->delete( $path_parts['dirname'].'/'.$name.'/'.$path_parts['basename'] ) ;
    }
    return back() ;
  }
  
  /**
   * make file default
   * 
   * @return Redirect
   */
  public function default(Request $request, $id, $type='product')
  {
    $file = $request->get('file');
    $model = 'App\\Models\\'.ucfirst($type) ;
    $item = $model::find($id) ; 
    $item->defaultImage = $file ;
    $item->save() ;
    Return back() ;
  }
}