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
    public $name, $description, $price, $engine_power, $spaciousness, $certificate, $location, $short_description, $images;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'engine_power', 'spaciousness', 'certificate', 'location', 'short_description'], 'required'],
            ['price', 'number'],
            [['images'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg'],
        ];
    }

    public function save() {
        $boat = new BoatsModel();
        foreach (array_keys($this->getAttributes()) as $attribute)
            if ($attribute != 'images') $boat->$attribute = $this->$attribute;

        $boat->save();

        foreach ($this->images as $img) {
            $image = new ImagesModel();
            $image->path = Yii::$app->params['uploadsPath']."/{$img->baseName}.{$img->extension}";
            $boat->link('images', $image);
        }

        return $boat->id;
    }

    public function upload(){
        foreach ($this->images as $image) {
            $image->saveAs(Yii::$app->params['uploadsPath'] . "/{$image->baseName}.{$image->extension}");
        }
        return true;
    }

    public function loadData($arModel){
        foreach (array_keys($this->getAttributes()) as $attribute)
            $this->$attribute = $arModel->$attribute;
    }
}
