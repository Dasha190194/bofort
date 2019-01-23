<?php
/**
 * Created by PhpStorm.
 * User: dogienko
 * Date: 02.07.18
 * Time: 12:50
 */

namespace app\helpers;


use Yii;

class ImageUpload
{
    public static $IMAGE_SIZES = [
            'widescreen' => [420, 270],
            'general' => [[100, 100], [250, 250]],
            'place' => [[1600, 900], [800, 450]]
    ];

    /**
     * @param null/string $size размер изображения
     * TODO это пока наброски
     */
//    static function saveImageToReady($image, $size = 'widescreen') {
//
//        $name = md5($image) . '.jpg';
//        $tp1 = substr(md5(microtime()), mt_rand(0, 30), 2);
//        $tp2 = substr(md5(microtime()), mt_rand(0, 30), 2);
//        $dir = $tp1 . '/' .$tp2;
//
//        $path = Yii::$app->params['upload_path'].'/ready/original/'. $dir;
//
//        umask(0);
//        mkdir($path, 0777, true);
//
//        self::resizeAndSave($image, 420, 270, $path, $name, $dir);
//        self::resizeAndSave($image, 250, 250, $path, $name, $dir);
//        self::resizeAndSave($image, 100, 100, $path, $name, $dir);
//
//        return $dir. '/'.$name;
//    }

//    private static function resizeAndSave($image, $width, $height, $path, $name, $dir) {
//        $source = \imagecreatefromjpeg($image);
//
//        \imagejpeg($source,$path. '/'.$name);
//
//        $image_p = \imagecreatetruecolor($width, $height);
//        $image = \imagecreatefromjpeg($path . '/' . $name);
//        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height,   $w_src = imagesx($image), imagesy($image));
//
//        umask(0);
//        mkdir(Yii::$app->params['upload_path'].'/ready/'.$width.'x'.$height.'/'. $dir, 0777, true);
//        imagejpeg($image_p,Yii::$app->params['upload_path'].'/ready/'.$width.'x'.$height.'/'. $dir. '/'.$name);
//    }

}