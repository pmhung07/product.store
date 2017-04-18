<?php namespace Nht\Hocs\Core\Uploads\Exceptions;

class FileTypeIsNotAllowedException extends \Exception {

	public function __construct(array $extensions) {
      $message = 'File này không được phép upload!. Những file được upload bao gồm: ';

		foreach($extensions as $ext) {
			$message .= '*.'. $ext . ', ';
		}

		$message = trim($message, ', ');

      parent::__construct($message, 1);
   }
}