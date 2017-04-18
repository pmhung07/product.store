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


    // Mảng resize image
    'array_resize_image' => [
        'sm_'  => ['width' => 100, 'height' => 5000],
        'md_'  => ['width' => 200, 'height' => 5000],
        'lg_'  => ['width' => 400, 'height' => 5000],
        'xlg_' => ['width' => 600, 'height' => 5000]
    ],


    // Mảng crop image
    'array_crop_image' => [
        'sm_'  => ['width' => 100, 'height' => 80],
        'md_'  => ['width' => 200, 'height' => 160],
        'lg_'  => ['width' => 400, 'height' => 320],
        'xlg_' => ['width' => 600, 'height' => 480]
    ],

    // Mảng mặc định
    'thumbs' => [
        'sm_' => ['width' => 320, 'height' => 240],
        'md_' => ['width' => 480, 'height' => 360],
        'lg_' => ['width' => 640, 'height' => 480]
    ]

);