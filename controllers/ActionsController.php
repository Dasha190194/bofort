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
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ActionsController extends Controller
{

    public $layout = '@app/views/admin/layouts/main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];

    }

    public function actionIndex() {
        $actions = ActionsModel::find()->all();

        return $this->render('index', compact('actions'));
    }

    public function actionCreate() {
        $model = new ActionForm();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $action = new ActionsModel();
            $model->save($action);
            $this->redirect('index');
        }

        $boats = BoatsModel::find()->all();

        return $this->render('create', compact('model', 'boats'));
    }

    public function actionUpdate(int $id) {
        $model = new ActionForm();
        $action = ActionsModel::findOne($id);

        if(!$action) throw new NotFoundHttpException('Not found.');

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $model->save($action);
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