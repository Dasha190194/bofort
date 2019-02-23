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

class CategoryForm extends Model
{
    public $name, $description, $images;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['images'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'description' => 'Описание',
            'images' => 'Фотографии'
        ];
    }

    public function save(CategoryModel $category) {
        foreach (array_keys($this->getAttributes()) as $attribute)
            if ($attribute != 'images') $category->$attribute = $this->$attribute;

        $category->save();

        foreach ($this->images as $img) {
            $image = new ImagesModel();
            $image->path = "{$img->baseName}.{$img->extension}";
            $category->link('images', $image);
        }

        return $category->id;
    }

    public function upload(){
        foreach ($this->images as $image) {
            $path = Yii::$app->params['uploadsPath']."origin/{$image->baseName}.{$image->extension}";
            $image->saveAs($path);
            Image::thumbnail($path, 250, 150)->save(Yii::$app->params['uploadsPath']."250X150/{$image->baseName}.{$image->extension}", ['quality' => 80]);
            Image::thumbnail($path, 350, 200)->save(Yii::$app->params['uploadsPath']."350X200/{$image->baseName}.{$image->extension}", ['quality' => 80]);
            Image::thumbnail($path, 550, 350)->save(Yii::$app->params['uploadsPath']."550X350/{$image->baseName}.{$image->extension}", ['quality' => 80]);
        }
        return true;
    }

    public function loadData($arModel){
        foreach (array_keys($this->getAttributes()) as $attribute)
            $this->$attribute = $arModel->$attribute;

    }
}
