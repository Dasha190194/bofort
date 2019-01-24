<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 16:07
 */

namespace app\models;


use yii\db\ActiveRecord;

class BoatsModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'boats';
    }

    public function getImage() {
        return $this->hasOne(ImagesModel::className(), ['boat_id' => 'id']);
    }

    public function getImages() {
        return $this->hasMany(ImagesModel::className(), ['boat_id' => 'id']);
    }

    public function getServices()
    {
        return $this->hasMany(ServicesModel::className(), ['id' => 'service_id'])
            ->viaTable('boat_services', ['boat_id' => 'id']);
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