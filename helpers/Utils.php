<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 04.01.19
 * Time: 7:28
 */

namespace app\helpers;


class Utils
{
    public static function userPrice($price) {
        return $price . ' руб.';
    }

    public static function boatMinPrice($price) {
        return $price . ' руб./час';
    }

}