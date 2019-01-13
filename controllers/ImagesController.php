<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 13.01.19
 * Time: 14:48
 */

namespace app\controllers;


use yii\imagine\Image;
use yii\web\Controller;

class ImagesController extends Controller
{
    public function actionThumbnail($path, $width, $height) {

        return Image::thumbnail($path, $width, $height)->show('jpg');
    }
}