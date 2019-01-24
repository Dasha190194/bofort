<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 29.12.18
 * Time: 17:30
 */

namespace app\controllers;


use app\models\BoatActionsForm;
use app\models\BoatForm;
use app\models\BoatsModel;
use app\models\OrderCreateForm;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class BoatsController extends Controller
{
    public function actionIndex() {
        $boats = BoatsModel::find()->all();

        return $this->render('index', compact('boats'));
    }

    /**
     * Страница лодки
     * @param int $id
     */
    public function actionShow(int $id) {

        $boat = BoatsModel::findOne($id);
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

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            try {
                $model->images = UploadedFile::getInstances($model, 'images');
                if (!$model->upload()) throw new Exception('Ошибка сохранения изображения!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'boats.create');
            }

            $id = $model->save();
            $this->redirect(['show', 'id' => $id]);
        }

        $model->loadData($boat);
        return $this->render('update', compact('model'));
    }

    /**
     * Создание лодки
     * @param int $id
     */
    public function actionCreate() {
        $model = new BoatForm();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {

            try {
                $model->images = UploadedFile::getInstances($model, 'images');
                if (!$model->upload()) throw new Exception('Ошибка сохранения изображения!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'boats.create');
            }

            $id = $model->save();
            $this->redirect(['show', 'id' => $id]);
        }

        return $this->render('create', compact('model'));
    }

    public function actionActions() {

        $query = BoatsModel::find(); // where `id` is your primary key
        $model = new BoatActionsForm();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('actions', compact('dataProvider', 'model'));
    }
}