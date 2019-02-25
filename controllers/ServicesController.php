<?php

/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.01.19
 * Time: 8:35
 */

namespace app\controllers;

use app\models\BoatsModel;
use app\models\ServiceForm;
use app\models\ServicesModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ServicesController extends Controller
{
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
        $services = ServicesModel::find()->all();

        return $this->render('index', compact('services'));
    }

    public function actionCreate() {
        $model = new ServiceForm();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $service = new ServicesModel();
            $model->save($service);
            $this->redirect('index');
        }

        $boats = BoatsModel::find()->all();

        return $this->render('create', compact('model', 'boats'));
    }

    public function actionUpdate(int $id) {
        $model = new ServiceForm();
        $service = ServicesModel::findOne($id);

        if(!$service) throw new NotFoundHttpException('Not found.');

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {

            foreach ($service->boats as $boat) {
                $service->unlink('boats', $boat);
            }

            $model->save($service);
            $this->redirect('index');
        }

        $model->loadData($service);
        $boats = BoatsModel::find()->all();
        return $this->render('update', compact('model','service', 'boats'));
    }

    public function actionDelete(int $id) {
        $service = ServicesModel::findOne($id);
        $service->delete();
        $this->redirect('index');
    }
}