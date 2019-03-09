<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.01.19
 * Time: 19:15
 */

namespace app\models;


use yii\db\ActiveRecord;

class NotificationsModel extends ActiveRecord
{
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['text', 'type'], 'safe'],
        ];
    }


    public static function tableName()
    {
        return 'notifications';
    }

    public function open() {
        $this->is_open = 1;
        $this->save();
    }

}