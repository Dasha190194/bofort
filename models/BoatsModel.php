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

class BoatsModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'boats';
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
        return $this->hasOne(ImagesModel::className(), ['boat_id' => 'id']);
    }

    public function getImages() {
        return $this->hasMany(ImagesModel::className(), ['boat_id' => 'id']);
    }

    public function getServices(){
        return $this->hasMany(ServicesModel::className(), ['id' => 'service_id'])
            ->viaTable('boat_services', ['boat_id' => 'id']);
    }

    public function getActions(){
        return $this->hasMany(ActionsModel::className(), ['id' => 'actions_id'])
            ->viaTable('boat_actions', ['boat_id' => 'id']);
    }

    public function getTariff() {
        return $this->hasOne(TariffsModel::className(), ['boat_id' => 'id']);
    }

    public function getServicesName() {
        $services = $this->getServices()->all();
        $servicesId = [];
        foreach ($services as $service) {
            $servicesId[] = $service->name;
        }
        return $servicesId;
    }
}