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
use app\models\OrderCreateForm;
use Yii;
use yii\base\ErrorException;
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

        $form = new BoatForm();

        $post = Yii::$app->request->post();
        $boat->load($post);
        if ($boat->load($post) && $boat->validate()) {

            $boat->save();
            return $this->redirect('/boats/show?id='.$boat->id);
        }

        return $this->render('update', compact('boat', 'form'));
    }

    /**
     * Редактирование лодки
     * @param int $id
     */
    public function actionCreate() {

        $boat = new BoatsModel();
        $form = new BoatForm();

        $post = Yii::$app->request->post();
        $form->load($post);
        if ($form->load($post) && $form->validate()) {

            if ($boat->save()) {
                $form->image = UploadedFile::getInstance($boat, 'image');
                $form->upload();
            }
            return $this->redirect('/boats/show?id='.$boat->id);
        }



        return $this->render('create', compact('boat', 'form'));
    }
}