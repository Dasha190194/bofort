<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.12.18
 * Time: 16:44
 */

namespace app\models;


use app\helpers\CloudPayments\InputPayAnswer;
use yii\db\ActiveRecord;

class CardsModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'cards';
    }

    // TODO еще подумать над логикой
    public function createCardIfNoExist(InputPayAnswer $input) {
        $cards = $this::find()->where(['user_id' => $input->accountId])->all();
        if (empty($cards)) {
            $this->first_six = $input->cardFirstSix;
            $this->last_four = $input->cardLastFour;
            $this->exp_date = $input->cardExpDate;
            $this->token = $input->token;
            $this->user_id = $input->accountId;
            $this->type = $input->cardType;
            $this->state = 1;
            $this->save();
        } else {
            if (!$this::find()->where(['token' => $input->token, 'user_id' => $input->accountId])->one()) {
                $this->first_six = $input->cardFirstSix;
                $this->last_four = $input->cardLastFour;
                $this->exp_date = $input->cardExpDate;
                $this->token = $input->token;
                $this->user_id = $input->accountId;
                $this->type = $input->cardType;
                $this->state = 0;
                $this->save();
            }
        }
    }
}
