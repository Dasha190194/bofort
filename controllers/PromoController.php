<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.01.19
 * Time: 20:27
 */

namespace app\controllers;


use app\models\PromoModel;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\web\Controller;

class PromoController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'change-active'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];

    }

    public function actionIndex() {
        $promos = PromoModel::find()->all();

        return $this->render('index', compact('promos'));
    }

    public function actionCreate() {
        $promo = new PromoModel();

        $post = Yii::$app->request->post();
        if ($promo->load($post) && $promo->validate()) {
            $promo->save();
            $this->redirect('index');
        }
        return $this->render('create', compact('promo'));
    }

    public function actionUpdate(int $id) {
        $promo = PromoModel::findOne($id);
        if(!$promo) throw new ErrorException('Not found.');

        $post = Yii::$app->request->post();
        if ($promo->load($post) && $promo->validate()) {
            $promo->save();
            $this->redirect('index');
        }
        return $this->render('update', compact('promo'));
    }

    public function actionChangeActive(int $id) {
        $promo = PromoModel::findOne($id);
        if(!$promo) throw new ErrorException('Not found.');

        $promo->is_active = !$promo->is_active;
        $promo->save();

        $this->redirect('index');
    }

}