<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.01.19
 * Time: 20:48
 */

namespace app\controllers;


use app\models\NotificationsModel;
use app\models\OrdersModel;
use app\models\User;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class NotificationsController extends Controller
{
    public $layout = '@app/views/admin/layouts/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];

    }

    public function actionOpen($id) {

        $response = [
            'success' => true,
            'result' => ''
        ];

        try {
            $notification = NotificationsModel::findOne($id);
            $notification->open();

            $count_new_notifications = NotificationsModel::find()->where(['user_id' => Yii::$app->user->identity->getId(), 'is_open' => 0])->count();
            $response['result'] = ['count' => $count_new_notifications];
        } catch (Exception $e) {
            Yii::error($e->getMessage(), 'app.notifications.open');
            $response['success'] = false;
        }

        return json_encode($response);
    }

    public function actionClearAll() {
        $response = [
            'success' => true,
            'result' => ''
        ];

        try {
            NotificationsModel::deleteAll(['user_id' => Yii::$app->user->identity->getId()]);
        } catch (Exception $e) {
            Yii::error($e->getMessage(), 'app.notifications.clearAll');
            $response['success'] = false;
        }

        return json_encode($response);
    }

    public function actionIndex() {
        $notifications = NotificationsModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $notifications,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate() {
        $model = new NotificationsModel();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate()) {
            foreach ($model->type as $type) {
                switch ($type):
                    case 0:
                        foreach (User::find()->all() as &$user) {
                            $notify = new NotificationsModel();
                            $notify->user_id = $user->id;
                            $notify->text = $model->text;
                            $notify->save();
                        }
                        break;
                    case 1000:
                        foreach (OrdersModel::find()->where(['state' => 1])->andWhere(['<', 'datetime_from', 'now()'])->all() as &$order) {
                            $notify = new NotificationsModel();
                            $notify->user_id = $order->user_id;
                            $notify->text = $model->text;
                            $notify->save();
                        }
                        break;
                    default:
                        $notify = new NotificationsModel();
                        $notify->user_id = $type;
                        $notify->text = $model->text;
                        $notify->save();
                endswitch;
            }
            $this->redirect('index');
        }

        return $this->render('create', compact('model'));
    }

}