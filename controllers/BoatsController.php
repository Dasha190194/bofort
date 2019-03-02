<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 29.12.18
 * Time: 17:30
 */

namespace app\controllers;


use app\models\BoatForm;
use app\models\BoatsModel;
use app\models\CategoryModel;
use app\models\OrderCreateForm;
use app\models\TariffForm;
use app\models\TariffsModel;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class BoatsController extends Controller
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
                        'actions' => ['update', 'create'],
                        'allow' => true,
                        'roles' => ['admin', 'shipowner'],
                    ],
                    [
                        'actions' => ['index', 'show', 'slug'],
                        'allow' => true,
                    ],
                ],
            ],
        ];

    }

    public function actionIndex($slug = null) {
        if (!is_null($slug)) {
            $category = CategoryModel::find()->where(['slug' => $slug])->one();
            if (!$category) throw new NotFoundHttpException('Not found.');

            $boats = $category->boats;
        } else {
            $boats = BoatsModel::find()->all();
        }

        return $this->render('index', compact('boats'));
    }

    /**
     * Страница лодки
     * @param int $id
     */
    public function actionShow(int $id) {
        $boat = BoatsModel::findOne($id);
        if (!$boat) throw new NotFoundHttpException('Not found.');

        $model = new OrderCreateForm();

        return $this->render('show', compact('boat', 'model'));
    }

    /*
     * Страница лодки через название
     */
    public function actionSlug($slug) {
        $boat = BoatsModel::find()->where(['slug'=>$slug])->one();
        if (!$boat) throw new NotFoundHttpException('Not found.');

        $model = new OrderCreateForm();

        return $this->render('show', compact('boat', 'model'));
    }


    /**
     * Редактирование лодки
     * @param int $id
     */
    public function actionUpdate(int $id) {

        $boat = BoatsModel::findOne($id);
        if(!$boat) throw new ErrorException('Not found.');

        $model = new BoatForm();
        $modelT = new TariffForm();

        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate() && $modelT->load($post) && $modelT->validate()) {
            try {
                $model->images = UploadedFile::getInstances($model, 'images');
                if (!$model->upload()) throw new Exception('Ошибка сохранения изображения!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'app.boats.create');
            }

            $id = $model->save($boat);

            $tariff = $boat->tariff;
            $tariff->boat_id = $id;
            $tariff->holiday = $modelT->holiday;
            $tariff->weekday = $modelT->weekday;
            $tariff->four_hours_holiday = $modelT->four_hours_holiday;
            $tariff->four_hours_weekday = $modelT->four_hours_weekday;
            $tariff->one_day = $modelT->one_day;
            $tariff->save();

            $this->redirect(['slug', 'slug' => $boat->slug]);
        }

        $model->loadData($boat);
        $modelT->loadData($boat->tariff);
        return $this->render('update', compact('model', 'modelT'));
    }

    /**
     * Создание лодки
     * @param int $id
     */
    public function actionCreate() {
        $model = new BoatForm();
        $modelT = new TariffForm();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate() && $modelT->load($post) && $modelT->validate()) {

            try {
                $model->images = UploadedFile::getInstances($model, 'images');
                if (!$model->upload()) throw new Exception('Ошибка сохранения изображения!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'app.boats.create');
            }

            $boat = new BoatsModel();
            $id = $model->save($boat);

            $tariff = new TariffsModel();
            $tariff->boat_id = $id;
            $tariff->holiday = $modelT->holiday;
            $tariff->weekday = $modelT->weekday;
            $tariff->four_hours_holiday = $modelT->four_hours_holiday;
            $tariff->four_hours_weekday = $modelT->four_hours_weekday;
            $tariff->one_day = $modelT->one_day;
            $tariff->save();

            $this->redirect(['show', 'id' => $id]);
        }

        return $this->render('create', compact('model', 'modelT'));
    }
}