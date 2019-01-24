<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.01.19
 * Time: 20:27
 */

namespace app\controllers;


use app\models\PromoModel;
use yii\web\Controller;

class PromoController extends Controller
{
    public function actionIndex() {
        $promos = PromoModel::find()->all();

        return $this->render('index', compact('promos'));
    }

    public function actionUpdate(int $id) {
        $promo = PromoModel::findOne($id);
        if(!$promo) throw new ErrorException('Not found.');

        $model = new PromoForm();
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $model->save();
            $this->redirect('index');
        }
        return $this->render('update', compact('model'));
    }

}