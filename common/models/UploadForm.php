<?php
namespace app\models;

use yii\base\Model;

class UploadForm extends Model
{

    public $imageFile;

    //制定规则
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg,PNG,JPG,JPEG'],
        ];
    }
    
    //上传
    public function upload()
    {
        $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
        return true;
    }
}