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
use yii\imagine\Image;
use yii\web\UploadedFile;

class BoatForm extends Model
{
    public  $name,
            $description,
            $engine_power,
            $spaciousness,
            $location_name,
            $lat,
            $long,
            $width,
            $length,
            $speed,
            $speed2,
            $category_id,
            $images;

    protected $time;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'description', 'engine_power', 'spaciousness', 'location_name', 'lat', 'long', 'width', 'length', 'speed', 'speed2', 'category_id'], 'required'],
            [['images'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg, jpeg'],
            ['description', 'filter', 'filter' => function ($value){
                return nl2br($value);
            }]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'description' => 'Описание',
            'engine_power' => 'Мощность',
            'spaciousness' => 'Вместимость',
            'location_name' => 'Наименование расположение',
            'lat' => 'Широта',
            'long' => 'Долгота',
            'width' => 'Ширина',
            'length' => 'Длина',
            'speed' => 'Максимальная скорость',
            'speed2' => 'Крейсерская',
            'category_id' => 'Категория',
            'images' => 'Фотографии'
        ];
    }

    public function save(BoatsModel $boat) {
        foreach (array_keys($this->getAttributes()) as $attribute)
            if ($attribute != 'images') $boat->$attribute = $this->$attribute;

        $boat->save();

        foreach ($this->images as $img) {
            $image = new ImagesModel();
            $image->path = "{$img->baseName}$this->time.{$img->extension}";
            $boat->link('images', $image);
        }

        return $boat->id;
    }

    public function upload(){
        $this->time = time();
        foreach ($this->images as $image) {
            $path = Yii::$app->params['uploadsPath']."origin/{$image->baseName}$this->time.{$image->extension}";
            $image->saveAs($path);
            Image::thumbnail($path, 250, 150)->save(Yii::$app->params['uploadsPath']."250X150/{$image->baseName}$this->time.{$image->extension}", ['quality' => 80]);
            Image::thumbnail($path, 350, 200)->save(Yii::$app->params['uploadsPath']."350X200/{$image->baseName}$this->time.{$image->extension}", ['quality' => 80]);
            Image::thumbnail($path, 550, 350)->save(Yii::$app->params['uploadsPath']."550X350/{$image->baseName}$this->time.{$image->extension}", ['quality' => 80]);
            Image::thumbnail($path, 1080, 720)->save(Yii::$app->params['uploadsPath']."1080X720/{$image->baseName}$this->time.{$image->extension}", ['quality' => 80]);
        }
        return true;
    }

    public function loadData($arModel){
        foreach (array_keys($this->getAttributes()) as $attribute)
            $this->$attribute = $arModel->$attribute;

    }
}
