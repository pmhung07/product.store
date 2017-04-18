<?php namespace Nht\Hocs\Core\Uploads;

use Nht\Hocs\Core\Uploads\Exceptions\UploadFolderDoesNotExistException;

class Uploader {

    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    public function upload($fileControl)
    {
        $pathUpload = $this->getUploadFolderPathToDay();
        $this->createPathIfNotExist();

        return $this->upload->upload($fileControl, $pathUpload);
    }


    public function uploadMulti($fileControl)
    {
        $pathUpload = $this->getUploadFolderPathToDay();
        $this->createPathIfNotExist();

        return $this->upload->uploadMulti($fileControl, $pathUpload);
    }

    public function getUploadFolderPathToDay() {
        $pathUpload = $this->upload->getUploadFolderPath().'/'. date('Y').'/'.date('m').'/'.date('d');
        return $pathUpload;
    }

    public function createPathIfNotExist() {
        $pathUpload = $this->getUploadFolderPathToDay();
        if(!is_dir($pathUpload)) {
            try {
                mkdir($pathUpload, 0755, true);
            } catch (\ErrorException $e) {
                throw new UploadFolderDoesNotExistException("Upload folder does not exist or you need chmod 777 to this folder", 1);
            }
        }
    }
}