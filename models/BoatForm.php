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
            [['name', 'description', 'price', 'engine_power', 'spaciousness', 'certificate', 'location', 'short_description'], 'required'],
            ['price', 'number'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function save() {
        $boat = new BoatsModel();
        foreach (array_keys($this->getAttributes()) as $attribute)
            if ($attribute != 'image') $boat->$attribute = $this->$attribute;

        $boat->save();

        $image = new ImagesModel();
        $image->path = Yii::$app->params['uploadsPath']."{$this->image->baseName}.{$this->image->extension}";
        $boat->link('images', $image);

        return $boat->id;
    }

    public function upload(){
        if($this->validate()){
            $this->image->saveAs(Yii::$app->params['uploadsPath']."{$this->image->baseName}.{$this->image->extension}");
            return true;
        }else{
            return false;
        }
    }

    public function loadData($arModel){
        foreach (array_keys($this->getAttributes()) as $attribute)
            $this->$attribute = $arModel->$attribute;
    }
}
