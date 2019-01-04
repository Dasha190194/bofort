<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 04.01.19
 * Time: 7:42
 */

namespace app\models;


use Yii;

class OrderSession
{
    public $services = [];

    public static function setSession($key, $value) {
        Yii::$app->session->set($key, $value);
        return true;
    }

    public static function getSession($key) {
        return Yii::$app->session->get($key);
    }

}