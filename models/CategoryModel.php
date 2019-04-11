<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 16:07
 */

namespace app\models;


use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

class CategoryModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'name',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ]
        ];
    }

    public function getImage() {
        return $this->hasOne(ImagesModel::className(), ['category_id' => 'id']);
    }

    public function getImages() {
        return $this->hasMany(ImagesModel::className(), ['category_id' => 'id']);
    }

    public function getBoats() {
        return $this->hasMany(BoatsModel::className(), ['category_id' => 'id']);
    }

    public function getMinPrice() {
        if (!$boats = $this->getBoats()->all()) return 0;
        $prices = [];
        foreach ($boats as &$boat) $prices[] = $boat->getMinTariff();
        return min($prices);
    }
}