<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.01.19
 * Time: 20:48
 */

namespace app\controllers;


use app\models\NotificationsModel;
use Exception;
use Yii;
use yii\web\Controller;

class NotificationsController extends Controller
{
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

}