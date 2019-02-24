<?php

namespace app\controllers;

use app\models\BlockForm;
use app\models\BoatsModel;
use app\models\OrdersModel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;


class AdminController extends Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'shipowner'],
                    ],
                    [
                        'actions' => ['orders', 'services'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['my-boat'],
                        'allow' => true,
                        'roles' => ['shipowner']
                    ]
                ],
            ],
        ];
    }


    public function actionIndex() {
        return $this->render('index');
    }

    public function actionOrders() {

        $post = Yii::$app->request->post();
        if (isset($post['editableKey'])) {
            $order = OrdersModel::findOne($post['editableKey']);
            $posted = current($post[$order->formName()]);
            $post[$order->formName()] = $posted;
            $order->load($post);
            return $this->asJson(['output'=>'', 'message'=>'']);
        }

        $orders = OrdersModel::find()->where(['state' => 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $orders,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('orders', compact('dataProvider'));
    }

    public function actionMyBoat(int $id) {
        $boat = BoatsModel::findOne($id);
        $model = new BlockForm();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $order = OrdersModel::createFictitiousOrder($model);
        }

        return $this->render('my-boat', compact('boat', 'model'));
    }
}
