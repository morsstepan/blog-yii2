<?php

namespace app\models;

use yii\base\Model;
use yii\base\UploadedFile;

class ImageUpload extends Model{


    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg, png']
        ];
    }

    public function uploadImage($file, $currentImage)
    {
        //var_dump($this->isExist($currentImage) && $this->isFile($currentImage));
        // var_dump($file);

            //var_dump($file);
            $this->image = $file;
            if ($this->validate()) {
                $this->deleteImage($currentImage);
                return $this->saveImage();
            }

    }

    private function getFolder()
    {
        return \Yii::getAlias('@web') . 'uploads/';
    }

    private function generateUniqueFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);

    }

    public function deleteImage($currentImage)
    {
        //var_dump($currentImage);
        //var_dump(($this->isExist($currentImage)));
        if ($this->isExist($currentImage) && $this->isFile($currentImage)) {
            unlink($this->getFolder() . $currentImage);

        }
    }

    private function isFile($currentImage)
    {
        return is_file($this->getFolder() . $currentImage);
    }

    private function isExist($currentImage)
    {
        return file_exists($this->getFolder()) . $currentImage;
    }

    private function saveImage()
    {
        $fileName = $this->generateUniqueFileName();
        $this->image->saveAs($this->getFolder() . $fileName);
        return $fileName;
    }
}