<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.02.19
 * Time: 20:11
 */

namespace app\components\Sms;

class SmsModel {

    public $to;
    public $msg;
    public $multi;
    public $from;
    public $time;
    public $translit;
    public $test;
    public $partner_id;

    public function __construct($number, $text) {
        $this->to = $number;
        $this->msg = $text;
        $this->test = 1;
    }
}