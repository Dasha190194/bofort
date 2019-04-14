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
    static $cardsState = [
        0 => 'Не основная',
        1 => 'Основная',
        2 => 'Удаленная'
    ];

    public static function tableName()
    {
        return 'cards';
    }

    // TODO еще подумать над логикой
    public static function createCardIfNoExist(InputPayAnswer $input) {
        $cards = self::find()->where(['user_id' => $input->accountId])->all();
        if (empty($cards)) {
            $card = new self;
            $card->first_six = $input->cardFirstSix;
            $card->last_four = $input->cardLastFour;
            $card->exp_date = $input->cardExpDate;
            $card->token = $input->token;
            $card->user_id = $input->accountId;
            $card->type = $input->cardType;
            $card->state = 1;
            $card->save();
        } else {
            if ($input->token != null) {
                $card = self::find()->where(['token' => $input->token, 'user_id' => $input->accountId])->one();
                if (!$card) {
                    $card = new self;
                    $card->first_six = $input->cardFirstSix;
                    $card->last_four = $input->cardLastFour;
                    $card->exp_date = $input->cardExpDate;
                    $card->token = $input->token;
                    $card->user_id = $input->accountId;
                    $card->type = $input->cardType;
                    $card->state = 0;
                    $card->save();
                }
            }
        }

        return $card;
    }
}
