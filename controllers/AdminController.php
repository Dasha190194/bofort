<?php

namespace app\controllers;

use Yii;
use amnah\yii2\user\models\User;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;


class AdminController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }
}
