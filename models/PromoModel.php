<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 02.01.19
 * Time: 17:14
 */

namespace app\models;


use yii\db\ActiveRecord;

class PromoModel extends ActiveRecord
{
    public static $types = [
        1 => '%',
        2 => 'фиксировано'
    ];

    public static $uses = [
        1 => '1 использование',
        2 => 'массовое'
    ];

    public static function tableName()
    {
        return 'promo';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['word', 'count', 'count_to_use', 'type', 'is_active'], 'required'],
        ];
    }

    public function getPromoHistory() {
        return $this->hasMany(PromoHistoryModel::className(), ['id' => 'promo_id']);
    }

    public function getPromoHistoryByUser($userId) {
        return $this->hasMany(PromoHistoryModel::className(), ['promo_id' => 'id'])->where(['user_id' => $userId])->count();
    }
}