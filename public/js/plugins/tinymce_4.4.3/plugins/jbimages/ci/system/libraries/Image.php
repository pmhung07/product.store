<?php

/**
 * Class Upload anh va Resize anh
 * @author Cong Luong
 * @Last Edit - 27/04/2014
 */
class Image {

	/**
	 * Mang resize
	 * @var array
	 */
	protected $arrayResize = array(
		'source' => array('width' => 700, 'height' => 1000),
		'small'  => array('width' => 50, 'height' => 50),
		'medium' => array('width' => 150, 'height' => 150)
	);


	/**
	 * Mang loi
	 * @var [type]
	 */
	protected $errors = array();

	/**
	 * Mang extension cho phep upload
	 * @var array
	 */
	protected $extensions = array('gif','jpg','jpeg','png');

	/**
	 * Max filesize upload
	 * @var integer
	 */
	protected $filesizeLimit = 10240; // Max filesize is 10MB

	protected $removeHaivlWaterMask = false;

	public function isSelectedFile($fileControl) {

		// Error code = 4, chua chon file de upload
		if( (isset($_FILES[$fileControl]['error']) && $_FILES[$fileControl]['error'] == 4) || !isset($_FILES[$fileControl])) {
			return false;
		}

		return true;

	}


	/**
	 * Upload anh
	 * @param  [type] $fileControl [description]
	 * @param  [type] $pathUpload  [description]
	 * @param  array  $arrayResize [description]
	 * @param  string $action Resize hay Crop
	 * @return [array]             [description]
	 */
	public function upload($fileControl, $pathUpload, array $arrayResize = array(), $action = 'resize') {
		//Mang ket qua tra ve
		$arrayReturn = array(
			'filename' => '',
			'path'     => '',
			'width'    => 0,
			'height'   => 0,
			'size'     => 0,
			'status'   => 0,
			'gif'      => 0,
			'thumb'    => array()
		);

		//Duong dan luu anh
		$pathUpload = rtrim($pathUpload, '/') . '/';

		if(!isset($_FILES[$fileControl])){
			$this->errors[] = 'Chưa chọn file upload';
			return $arrayReturn;
		}

		//Upload code
		$uploadErrorCode = $_FILES[$fileControl]['error'];

		if($uploadErrorCode > 0){
			$this->errors[] = $this->codeToMessage($uploadErrorCode);
			return $arrayReturn;
		}

		if(!empty($arrayResize)) $this->arrayResize = $arrayResize;

		if($this->checkExtension($_FILES[$fileControl]['tmp_name']) == false) {
			$this->errors[] = 'File này không được phép upload!';
			return $arrayReturn;
		}

		if($this->checkFilesizeLimit($_FILES[$fileControl]['tmp_name']) == false) {
			$this->errors[] = 'Dung lượng file quá lớn!';
			return $arrayReturn;
		}

		$newFilename = $this->createFilename($_FILES[$fileControl]['tmp_name']);

		if(move_uploaded_file($_FILES[$fileControl]['tmp_name'], $pathUpload . $newFilename)) {
			list($width, $height)    = getimagesize($pathUpload . $newFilename);
			$fullPathFile = $pathUpload . $newFilename;
			$arrayReturn['filename'] = $newFilename;
			$arrayReturn['path']     = $fullPathFile;
			$arrayReturn['width']    = $width;
			$arrayReturn['height']   = $height;
			$arrayReturn['size']     = filesize($fullPathFile) / 1024;
			$arrayReturn['status']   = 1;

			//Resize or Crop image
			if($action == 'crop') {
				$resultThumb          = $this->crop($fullPathFile, $pathUpload, $this->arrayResize);
				$arrayReturn['thumb'] = $resultThumb;
			} else if($action == 'resize'){
				$resultThumb          = $this->resize($fullPathFile, $pathUpload, $this->arrayResize);
				$arrayReturn['thumb'] = $resultThumb;
			}

			//Resize gif
			if(exif_imagetype($fullPathFile) == IMAGETYPE_GIF) {
				$arrayReturn['gif'] = 1;
			}
		}

		return $arrayReturn;
	}


	/**
	 * Upload nhieu anh
	 * @param  [type] $fileControl [description]
	 * @param  [type] $pathUpload  [description]
	 * @param  array  $arrayResize [description]
	 * @return [type]              [description]
	 */
	public function uploadMulti($fileControl, $pathUpload, array $arrayResize = array(), $action = 'resize') {
		$arrayResult = array('file_name' => array(), 'thumb' => array());

		foreach ($_FILES[$fileControl]["error"] as $key => $error) {
		   if ($error == UPLOAD_ERR_OK
		   	&& in_array($this->getExtension($_FILES[$fileControl]["tmp_name"][$key]), $this->extensions)) {

				$tmp_name = $_FILES[$fileControl]["tmp_name"][$key];
				$name     = $this->createFilename($_FILES[$fileControl]["tmp_name"][$key]);
				move_uploaded_file($tmp_name, $pathUpload . $name);

				if($action == 'resize') {
					$resultResize = $this->resize($pathUpload . $name, $pathUpload, $arrayResize);
				}elseif($action == 'crop'){
					$resultResize = $this->crop($pathUpload . $name , $pathUpload, $arrayResize);
				}

				$arrayResult['file_name'][$name] = $name;
				$arrayResult['thumb'][$name]     = $resultResize;
		   }
		}

		return $arrayResult;
	}


	public function removeHaivlWaterMask() {
		$this->removeHaivlWaterMask = true;
	}


	/**
	 * Resize anh thanh small va medium
	 * @param  [type] $fullPathFile [description]
	 * @param  [type] $pathUpload   [description]
	 * @param  [type] $arrayResize  [description]
	 * @return [array]              [description]
	 */
	public function resize($fullPathFile, $pathUpload, $arrayResize) {
		$arrayReturn = array(
			'status' => 0,
			'filename' => '',
			'small'  => array(
				'width'    => 0,
				'height'   => 0,
				'filename' => ''
			),
			'medium' => array(
				'width'    => 0,
				'height'   => 0,
				'filename' => ''
			)
		);
		//Lay ten file
		$slash    = strrpos($fullPathFile, '/');
		$filename = substr($fullPathFile, $slash + 1, strlen($fullPathFile));

		$imagename = $fullPathFile;

		$extension  = $this->getExtension($imagename);

		list($width,$height) = getimagesize($imagename);

		switch($extension){
			case 'gif' :
				$image  = imagecreatefromgif($imagename);
				break;

			case 'png' :
				$image  = imagecreatefrompng($imagename);
				break;

			case 'jpg' :
			case 'jpeg':
				$image  = imagecreatefromjpeg($imagename);
				break;

		}

		foreach($arrayResize as $type => $size){

			$typeShift = $type . '_';

			if($width > $size['width']){
				$percent = $size['width'] / $width;
			}else{
				$percent = $width / $size['width'];
			}

			$newWidth  = $width * $percent > 0 ? $width * $percent : 1;
			$newHeight = $height * $percent > 0 ? $height * $percent : 1;

			$thumb = imagecreatetruecolor($newWidth, $newHeight);
			imagealphablending($thumb, false);
 			imagesavealpha($thumb,true);

			if($this->removeHaivlWaterMask) {
				$offSetYWaterMask = -20;
				imagecopyresampled($thumb, $image, 0, $offSetYWaterMask, 0, $offSetYWaterMask, $newWidth, $newHeight + 30, $width, $height);
			}else{
				imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			}


			$pathSaveFile = $pathUpload . $typeShift . $filename;

			switch($extension){
				case 'gif' :
					$source = imagegif($thumb, $pathUpload . $typeShift . $filename);
					break;

				case 'png' :
					$source = imagepng($thumb, $pathUpload . $typeShift . $filename, 9);
					break;

				case 'jpg' :
				case 'jpeg':
					$source = imagejpeg($thumb, $pathUpload . $typeShift . $filename, 100);
					break;
			}

			//Set ket qua tra ve
			list($thumbWidth, $thumbHeight) = getimagesize($pathUpload . $typeShift . $filename);
			$arrayReturn['status']          = 1;
			$arrayReturn[$type]['width']    = $thumbWidth;
			$arrayReturn[$type]['height']   = $thumbHeight;
			$arrayReturn[$type]['filename'] = $typeShift . $filename;
		}

		$arrayReturn['filename'] = $filename;

		return $arrayReturn;

	}


	public function crop($fullPathFile, $pathUpload, $arrayResize) {
		$arrayReturn = array(
			'status' => 0,
			'filename' => '',
			'small'  => array(
				'width'    => 0,
				'height'   => 0,
				'filename' => ''
			),
			'medium' => array(
				'width'    => 0,
				'height'   => 0,
				'filename' => ''
			)
		);
		//Lay ten file
		$slash    = strrpos($fullPathFile, '/');
		$filename = substr($fullPathFile, $slash + 1, strlen($fullPathFile));

		$imagename = $fullPathFile;

		$extension  = $this->getExtension($imagename);

		list($width,$height) = getimagesize($imagename);

		switch($extension){
			case 'gif' :
				$image  = imagecreatefromgif($imagename);
				break;

			case 'png' :
				$image  = imagecreatefrompng($imagename);
				break;

			case 'jpg' :
			case 'jpeg':
				$image  = imagecreatefromjpeg($imagename);
				break;

		}

		foreach($arrayResize as $type => $size){

			$typeShift = $type . '_';

			$thumb_width = $size['width'];
			$thumb_height = $size['height'];

			$original_aspect = $width / $height;
			$thumb_aspect = $thumb_width / $thumb_height;

			if ( $original_aspect >= $thumb_aspect ) {
			   // If image is wider than thumbnail (in aspect ratio sense)
			   $new_height = $thumb_height;
			   $new_width = $width / ($height / $thumb_height);
			} else {
			   // If the thumbnail is wider than the image
			   $new_width = $thumb_width;
			   $new_height = $height / ($width / $thumb_width);
			}

			$thumb = imagecreatetruecolor($thumb_width, $thumb_height);

			imagecopyresampled($thumb,
									$image,
									0 - ($new_width - $thumb_width) / 2,
									0 - ($new_height - $thumb_height) / 2,
									0,
									0,
									$new_width, // Center the image horizontally
									$new_height, // Center the image vertically
									$width,
									$height);

			$pathSaveFile = $pathUpload . $typeShift . $filename;

			switch($extension){
				case 'gif' :
					$source = imagegif($thumb, $pathUpload . $typeShift . $filename);
					break;

				case 'png' :
					$source = imagepng($thumb, $pathUpload . $typeShift . $filename, 9);
					break;

				case 'jpg' :
				case 'jpeg':
					$source = imagejpeg($thumb, $pathUpload . $typeShift . $filename, 100);
					break;
			}

			//Set ket qua tra ve
			list($thumbWidth, $thumbHeight) = getimagesize($pathUpload . $typeShift . $filename);
			$arrayReturn['status']          = 1;
			$arrayReturn[$type]['width']    = $thumbWidth;
			$arrayReturn[$type]['height']   = $thumbHeight;
			$arrayReturn[$type]['filename'] = $typeShift . $filename;
		}

		$arrayReturn['filename'] = $filename;

		return $arrayReturn;
	}

	/**
	 * Lay anh tu 1 url anh
	 * @param  [type] $urlImage    [description]
	 * @param  [type] $pathUpload  [description]
	 * @param  [type] $arrayResize [description]
	 * @return [type]              [description]
	 */
	public function getImageFromUrl($urlImage, $pathUpload, $arrayResize = '') {
		$result = array(
			'filename' => '',
			'path'     => '',
			'width'    => 0,
			'height'   => 0,
			'size'     => 0,
			'status'   => 0,
			'gif'      => 0,
			'thumb'    => array()
		);

		$sourceImage = curlGetContent($urlImage);

		$name = $this->createFilename($urlImage);
		$pathSaveImage = $pathUpload . $name;

		$desImage = file_put_contents($pathSaveImage, $sourceImage);

		$extension = $this->getExtension($pathSaveImage);

		if(!$this->checkExtension($pathSaveImage)) {
			return $result;
		}

		if($this->removeHaivlWaterMask) {
			$imagename            = $pathUpload . $name;
			$pathSaveImageHaivl   = $pathUpload . $name;
			list($width, $height) = getimagesize($imagename);
			$newWidth             = $width;
			$newHeight            = $height;
			$image                = imagecreatefromjpeg($imagename);
			$thumb                = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($thumb, $image, 0, -30, 0, -30, $newWidth, $newHeight + 30, $width, $height);
			$extension = $this->getExtension($urlImage);
			switch($extension){
				case 'gif' :
					$source  = imagegif($thumb, $pathSaveImageHaivl, 100);
					break;

				case 'png' :
					$source = imagepng($thumb, $pathSaveImageHaivl, 9);
					break;

				case 'jpg' :
				case 'jpeg':
					$source = imagejpeg($thumb, $pathSaveImageHaivl, 100);
					break;
			}
		}

		if(!is_array($arrayResize)) {
			$arrayResize = array(
				'small'  => array('width' => 150, 'height' => 5000),
				'medium' => array('width' => 460, 'height' => 5000)
			);
		}

		//Resize gif
		if(exif_imagetype($pathSaveImage) == IMAGETYPE_GIF) {
			$result['gif'] = 1;
		}

		if(file_exists($pathSaveImage)) {

			//Lay width , height cua anh
			list($width, $height) = getimagesize($pathSaveImage);
			$result['width']      = $width;
			$result['height']     = $height;

			$result['filename']   = $name;
			$result['thumb']      = $this->resize($pathSaveImage, $pathUpload, $arrayResize);
			$result['path']       = $pathSaveImage;
			$result['size']       = filesize($pathSaveImage) / 1024;
			$result['status']     = 1;
		}

		return $result;
	}


	/**
	 * Lay extension
	 * @param  [type] $filename [description]
	 * @return [string extension]           [description]
	 */
	public function getExtension($filename) {

		$file_info	= @getimagesize($filename);
		$mime			= $file_info['mime'];
		$array_mime	= explode('/', $mime);
		$extension	= isset($array_mime[1]) ? strtolower($array_mime[1]) : null;
		return $extension;
	}


	/**
	 * Tao ten file moi
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	protected function createFilename($filename){
		$strSecret   = '!@#$%^&*()_+QBGFTNKU' . time() . rand(111111,999999);

		$filenameMd5 = substr(md5($filename . $strSecret),0,10);

		return date('Y_m_d') . '_' . $filenameMd5 . '.' . $this->getExtension($filename);
	}


	/**
	 * Kiem tra extension
	 * @param  [type] $filename [description]
	 * @return [true | false]           [description]
	 */
	protected function checkExtension($filename) {
		$extension = $this->getExtension($filename);

		if(!in_array($extension, $this->extensions)){
			return false;
		}

		return true;
	}



	/**
	 * Kiem tra dung luong upload cho phep
	 * @param  [type] $filename [description]
	 * @return [true | false]           [description]
	 */
	protected function checkFilesizeLimit($filename) {
		if(filesize($filename) / 1024 > $this->filesizeLimit){
			return false;
		}

		return true;
	}


	/**
	 * Convert code to error message
	 * @param  [type] $code [description]
	 * @return [type]       [description]
	 */
	protected function codeToMessage($code){
     switch ($code) {
         case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
         case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
         case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded";
            break;
         case UPLOAD_ERR_NO_FILE:
            $message = "No file was uploaded";
            break;
         case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder";
            break;
         case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk";
            break;
         case UPLOAD_ERR_EXTENSION:
            $message = "File upload stopped by extension";
            break;

         default:
             $message = "Unknown upload error";
             break;
     	}
        return $message;
   }


   /**
    * Lay ra tat ca cac loi
    * @return [type] [description]
    */
   public function getErrors() {
   	return $this->errors;
   }
}