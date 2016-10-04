<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    
    /*
    |--------------------------------------------------------------------------
    | Image sizes
    |--------------------------------------------------------------------------
    |
    | Here you can configure image sizes for your application
    | uploaded images will be resized by intervention
    | please arrange largest to smallest
    | for more information see http://image.intervention.io/api/resize
    |
    */

    'image_sizes' => [
      'large' => [800,600],
      'medium' => [400, 225],
      'thumb' => [160, 90],
    ],

);
