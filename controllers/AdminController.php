<?php

namespace app\controllers;

use app\models\ActForm;
use app\models\BlockForm;
use app\models\BoatsModel;
use app\models\CardsModel;
use app\models\ConfirmDataForm;
use app\models\OfertaForm;
use app\models\OrdersModel;
use app\models\TransactionsModel;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;


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
                        'actions' => ['orders', 'services', 'documents', 'write-money'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['my-boat', 'boats'],
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

    /*
     * Лодки владельца
     */
    public function actionBoats() {
        $user_id = Yii::$app->user->id;
        $boats = BoatsModel::find()->where(['user_id' => $user_id])->all();

        return $this->render('/boats/index', compact('boats'));
    }

    /*
     * Редактор оферты
     */
    public function actionDocuments() {
        $model = new OfertaForm();
        $modelConfirmData = new ConfirmDataForm();
        $modelAct = new ActForm();

        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate()) {
            try {
                $model->document = UploadedFile::getInstance($model, 'document');
                if (!$model->upload()) throw new Exception('Ошибка сохранения оферты!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'app.admin.documents');
            }
        }

        if ($modelConfirmData->load($post) && $modelConfirmData->validate()) {
            try {
                $modelConfirmData->document = UploadedFile::getInstance($modelConfirmData, 'document');
                if (!$modelConfirmData->upload()) throw new Exception('Ошибка сохранения пользовательского соглашения!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'app.admin.documents');
            }
        }

        if ($modelAct->load($post) && $modelAct->validate()) {
            try {
                $modelAct->document = UploadedFile::getInstance($modelAct, 'document');
                if (!$modelAct->upload()) throw new Exception('Ошибка сохранения акта приёма-передачи!');
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'app.admin.documents');
            }
        }

        return $this->render('documents', compact('model', 'modelConfirmData', 'modelAct'));
    }


    public function actionWriteMoney() {
        $card_id = Yii::$app->request->post('card_id');
        $money = Yii::$app->request->post('money');

        try {
            $card = CardsModel::findOne($card_id);

            $transaction = new TransactionsModel();
            $transaction->create(null, $money, Yii::$app->user->getId(), $card_id);

            $client = new \CloudPayments\Manager(Yii::$app->params['cloud_id'], Yii::$app->params['cloud_private_key']);
            $response = $client->chargeToken($money, 'RUB', Yii::$app->user->getId(), $card->token, ['InvoiceId' => 111111]);

            return $this->asJson(
                [
                    'success' => true,
                    'data' => $response->getId()
                ]);

        } catch (Exception $e) {
            Yii::error("Не удалаось списать деньги [".$e->getMessage()."]", 'app.default.write-money');
            return $this->asJson(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
        }
    }
}
