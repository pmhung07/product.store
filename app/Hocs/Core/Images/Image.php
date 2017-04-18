<?php namespace Nht\Hocs\Core\Images;

use \ImageIntervention as BaseImage;
use Input;

class Image {


	/**
	 * Build instance of BaseImage
	 *
	 * @param $resource
	 *
	 * @return BaseImage
	 */
	public function getImage($resource) {
		// _debug($resource);die;

		$image = BaseImage::make($resource);

		$image = BaseImage::make($resource);
		$mime  = $image->mime();

		switch ($mime) {
			case 'image/gif':
				return $image->encode('gif');

			case 'image/jpeg':
			   return $image->encode('jpg', 100);

			case 'image/png':
				return $image->encode('png', 9);

			case 'image/bmp':
				return $image->encode('bmp');
		}

		return $image;
	}


	/**
	 * Resize image
	 *
	 * @param  string $fullPathFile
	 * @param  path $pathUpload
	 * @param  array $arrayResize
	 *
	 * @return array thumbs
	 */
	public function resize($fullPathFile, $pathUpload, $arrayResize) {

		// Create new instance of Image
		$image = $this->getImage($fullPathFile);

		$fileName = explode('/', $fullPathFile);
		$fileName = end($fileName);

		$result = [];

		foreach($arrayResize as $imgType => $imgInfo) {
			$optionFileName = $pathUpload . $imgType . $fileName;

			$image->backup();
			// Resize with auto height
			$image->resize($imgInfo['width'], null, function ($constraint) {
			   $constraint->aspectRatio();
			})->save($optionFileName);

			$image->reset();

			// Set values return
			$result[$imgType] = $imgType . $fileName;
		}

		return $result;
	}


	/**
	 * Crop image
	 *
	 * @param  string $fullPathFile
	 * @param  string $pathUpload
	 * @param  array $arrayCrop
	 *
	 * @return array thumbs
	 */
	public function crop($fullPathFile, $pathUpload, $arrayCrop) {
		$image = $this->getImage($fullPathFile);

		$fileName = explode(DIRECTORY_SEPARATOR, $fullPathFile);
		$fileName = end($fileName);

		$result = [];

		foreach($arrayCrop as $imgType => $imgInfo) {
			$optionFileName = $pathUpload . $imgType . $fileName;
			$image->backup();
			$image->fit($imgInfo['width'], $imgInfo['height'])->save($optionFileName);
			$image->reset();

			// Set values return
			$result[$imgType] = $imgType . $fileName;
		}

		$image->destroy();

		return $result;
	}


	public function getMime($image) {
		// dd($image->mime());
		return $image->mime();
	}
}