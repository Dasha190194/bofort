<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 16.02.19
 * Time: 11:26
 */

namespace app\models;


use amnah\yii2\user\models\UserToken;
use Yii;
use yii\base\Model;

class PhoneConfirmForm extends Model
{
    public $phone, $code;

    public function rules()
    {
        return [
            ['code', 'check'],
            ['phone', 'required']
        ];
    }

    public function check($attribute, $params, $validator) {
        $userToken = UserToken::find()->where(['user_id' => Yii::$app->user->getId(), 'type' => 5])->orderBy(['id' => SORT_DESC])->one();
        if ($userToken->token != $this->$attribute) $this->addError($this->$attribute, 'Неверный код.');
    }

}