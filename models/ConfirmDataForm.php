<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 16:07
 */

namespace app\models;


use Yii;
use yii\base\Model;


class ConfirmDataForm extends Model
{
    public  $document;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [[['document'], 'file', 'extensions' => 'pdf']];
    }

    public function attributeLabels()
    {
        return [
            'document' => 'Документ'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->document->saveAs(Yii::$app->params['uploadsPath'].'confirm-data.'. $this->document->extension);
            return true;
        }
        return false;
    }

}