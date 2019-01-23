<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.01.19
 * Time: 20:20
 */

namespace app\models;


use Yii;
use yii\base\Model;

class BoatForm extends Model
{
    public $name, $description, $price, $engine_power, $spaciousness, $certificate, $location, $short_description, $image;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description', 'price', 'engine_power', 'spaciousness', 'certificate', 'location', 'short_description'], 'required'],
            ['price', 'number'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function save() {

    }

    public function upload(){
        if($this->validate()){
            $this->image->saveAs(Yii::$app->params['uploadsPath']."{$this->image->baseName}.{$this->image->extension}");
        }else{
            return false;
        }
    }

//    public function attributeLabels()
//    {
//        return [
//            'image_url' => 'Афиша пакета',
//            'description' => 'Описание пакета',
//            'image_file' => 'Афиша пакета'
//        ];
//    }

    public function upload()
    {
        if ($this->validate()) {
            if(!isset($this->image_file)) return true;
            $this->image->saveAs("uploads/{$this->image->baseName}.{$this->image->extension}");
            return true;
        } else {
            return false;
        }
    }
}
