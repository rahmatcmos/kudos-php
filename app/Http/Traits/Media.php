<?php
namespace App\Http\Traits;
use Storage ;

trait Media
{
    
  /**
   * return Files of type
   *
   * @param string $path
   * $param array $ext
   * 
   * @return array
   */
  public function getFiles( $path, $ext = ['jpg','jpeg','png'] )
  {
    $files = Storage::disk('public')->Files($path);
    $return = [] ;
    foreach($files as $file){
      $fileParts = pathinfo($file);
      if(in_array(strtolower($fileParts['extension']), $ext)){
        $return[] = $file ; 
      }
    }
    return $return ;
  }
  
}