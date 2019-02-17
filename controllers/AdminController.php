<?php

namespace app\controllers;

use app\models\OrdersModel;
use Yii;
use amnah\yii2\user\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;


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
                        'actions' => ['index', 'orders', 'services'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
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
            return  $this->asJson(['output'=>'', 'message'=>'']);
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
}
