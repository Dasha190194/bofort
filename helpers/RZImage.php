<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 13.01.19
 * Time: 12:24
 */

namespace app\helpers;


use Yii;
use yii\imagine\Image;

class RZImage {

    private $static;
    public $original;
    public $width;
    public $height;
    public $result;

    public function __construct($width, $height, $image) {
        $this->static = 'assets/static/';
        $this->width = $width;
        $this->height = $height;
        $this->original = $image;
        $this->result = $this->static . $this->width . 'x' . $this->height . '/' . $this->original;
    }

    public function originalExists() {
        return file_exists(Yii::getAlias('@webroot/') . $this->original);
    }

    public function resultExists() {
        return file_exists(Yii::getAlias('@webroot/') . $this->result);
    }

    private function checkFolder() {
        if(!is_dir(Yii::getAlias('@webroot/') . pathinfo($this->result, PATHINFO_DIRNAME))) {
            return mkdir(Yii::getAlias('@webroot/') . pathinfo($this->result, PATHINFO_DIRNAME), 0777, true);
        }
        return true;
    }

    public function getThumbnail() {
        if( $this->originalExists()) {

            if(!$this->resultExists()) {
                if($this->checkFolder()) {
                    Image::thumbnail(Yii::getAlias('@webroot/') . $this->original, $this->width, $this->height)->save(Yii::getAlias('@webroot/') . $this->result, ['quality' => 80]);
                } else {
                    throw new \yii\web\HttpException(424 ,'Не удалось создать папку для хранения превью.');
                }
            }
            return Image::thumbnail(Yii::getAlias('@webroot/') . $this->original, $this->width, $this->height)->render();

        } else {
            throw new \yii\web\HttpException(410 ,'Файл не найден. Скорее всего он был удален.');
        }
    }
}