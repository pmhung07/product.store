<?php namespace Nht\Hocs\Core\Uploads\Exceptions;

class UploadMaxFileSizeException extends \Exception {
	public function __construct($size) {
		$message = 'File quá lớn không thể upload. Giới hạn cho phép là ' . round($size/1024) . 'MB';
		parent::__construct($message, 1);
	}
}