<?php

namespace backend\controllers;

use Yii;
use backend\models\Transactions;
use backend\models\TransactionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionsController implements the CRUD actions for Transactions model.
 */
class TransactionsController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                ['access' => [
                        'class' => \yii\filters\AccessControl::class,
                        'only' => ['index', 'view', 'delete', 'update'],
                        'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login', 'signup'],
//                        'roles' => ['?'],
//                    ],
                            [
                                'allow' => true,
                                // 'actions' => ['index', 'view', 'delete','update'],
                                'roles' => ['@'],
                            ],
                        ],
                        'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                        }
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ]
        );
    }

    /**
     * Lists all Transactions models.
     *
     * @return string
     */
    public function actionIndex() {
//        $helper = new Helper();
        $searchModel = new TransactionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTodayVisitors() {
//        $helper = new Helper();
        $today = date('Y-m-d');
        // var_dump($today);die;
        $searchModel = new TransactionsSearch(['date' => $today]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transactions model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionHeadCount() {
        $helper = new Helper();
        $inout = Transactions::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['status' => 1])->andWhere(['date' => date('Y-m-d')])->count();
        var_dump($inout);
        die;
        return $this->render('head-count', [
                    'inout' => $inout]);
    }

    /**
     * Creates a new Transactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id) {
        $mid = $id;
        $model = new Transactions();
        $helper = new Helper();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->date = date('Y-m-d');
                date_default_timezone_set("Asia/Kathmandu");
                $model->time = date('h:i:s');
                $model->fk_org = $helper->getActiveOrganization();
                $model->created_by = $helper->getActiveUserId();
                $model->fk_member = $mid;
                if ($model->save()) {
                    $message = null;
                    if ($model->status == 1) {
                        $message = 'CHECK-IN';
                        Yii::$app->getSession()->setFlash('success',
                                ['type' => 'success',
                                    'icon' => 'fa fa-print',
                                    'message' => $message,
                                    'title' => 'CheckOut Notice']);
                    } else {
                        $message = 'CHECK-OUT';
                        Yii::$app->getSession()->setFlash('success',
                                ['type' => 'danger',
                                    'icon' => 'fa fa-print',
                                    'message' => $message,
                                    'title' => 'CheckOut Notice']);
                    }

                    return $this->redirect(['members/view', 'id' => $mid]);
                } else {
                    var_dump($model->errors);
                    die;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transactions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transactions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Transactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Transactions::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
