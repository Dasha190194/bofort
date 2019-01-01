<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 29.12.18
 * Time: 17:30
 */

namespace app\controllers;


use app\models\BoatsModel;
use app\models\OrderCreateForm;
use yii\web\Controller;

class BoatsController extends Controller
{

    /**
     * @param int $id
     */
    public function actionShow(int $id) {

        $boat = BoatsModel::findOne($id);
        $model = new OrderCreateForm();

        return $this->render('show', compact('boat', 'model'));
    }
}