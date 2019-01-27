<?php

/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.01.19
 * Time: 8:35
 */

namespace app\controllers;

use app\models\ActionForm;
use app\models\ActionsModel;
use app\models\BoatsModel;
use Yii;
use yii\base\ErrorException;
use yii\web\Controller;



class ActionsController extends Controller
{
    public function actionIndex() {
        $actions = ActionsModel::find()->all();

        return $this->render('index', compact('actions'));
    }

    public function actionCreate() {
        $model = new ActionForm();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $model->save();
            $this->redirect('index');
        }

        $boats = BoatsModel::find()->all();

        return $this->render('create', compact('model', 'boats'));
    }

    public function actionUpdate(int $id) {
        $model = new ActionForm();
        $action = ActionsModel::findOne($id);

        if(!$action) throw new ErrorException('Not found.');

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $model->save();
            $this->redirect('index');
        }

        $model->loadData($action);
        $boats = BoatsModel::find()->all();
        return $this->render('update', compact('model','action', 'boats'));
    }

    public function actionDelete(int $id) {
        $action = ActionsModel::findOne($id);
        $action->delete();
        $this->redirect('index');
    }
}