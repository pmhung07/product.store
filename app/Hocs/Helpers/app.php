<?php

if( ! function_exists('parse_image_url') ) {
    /**
     * Lấy url của ảnh
     * @param  str $image
     * @return url
     */
    function parse_image_url($image) {
        $explode = explode('___', $image);
        if(isset($explode[1])) {
            return '/'. config('upload.upload_folder') .'/' . date('Y/m/d', $explode[1]) . '/' . $image;
        }
    }
}


if( ! function_exists('setting') ) {
    /**
     * Setting metadata
     * @return Nht\Hocs\Core\Metadata\Metadata
     */
    function setting() {
        return resolve('Setting');
    }
}

if( ! function_exists('get_image_folder') ) {
    /**
     * Lấy tên folder chứa ảnh theo tên ảnh
     * @param  str $image
     * @return str
     */
    function get_image_folder($image) {
        $explode = explode('___', $image);
        if(isset($explode[1])) {
            return date('Y/m/d', $explode[1]);
        }

        return '';
    }
}

if( ! function_exists('gallery_init') ) {
    /**
     * Tạo control chọn ảnh gallery
     * @param  str $imgId
     * @param  str $controlName
     * @return str
     */
    function gallery_init($imgId, $controlName, $defaultValueControl = null) {
        return view('resource::admin/gallery/control', [
            'imgId'       => $imgId,
            'controlName' => $controlName,
            'defaultValueControl' => $defaultValueControl
        ]);
    }
}