<?php

namespace backend\controllers;

use Yii;
use backend\models\Points;
use backend\models\PointsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

$helper = new Helper();

/**
 * PointsController implements the CRUD actions for Points model.
 */
class PointsController extends Controller {

    /**
     * @inheritDoc
     */
//    public $layout = 'accountlayout.php';

    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                [
                    'access' => [
                        'class' => \yii\filters\AccessControl::class,
                        'only' => ['index', 'view', 'delete', 'update', 'create'],
                        'rules' => [
                            [
                                'allow' => true,
                                'actions' => ['index', 'view', 'delete', 'update', 'create'],
                                'roles' => ['@'],
                            ],
                        ],
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
     * Lists all Points models.
     *
     * @return string
     */
    public function actionIndex() {
        $helper = new Helper();
        if ($helper->getActiveUserRole() == 1) {
            $this->layout = 'mainindex.php';
        } elseif ($helper->getActiveUserRole() == 2) {
            $this->layout = 'pitlayout.php';
        } elseif ($helper->getActiveUserRole() == 3) {
            $this->layout = 'accountlayout.php';
        } elseif ($helper->getActiveUserRole() == 4) {
            $this->layout = 'cctvlayout.php';
        } elseif ($helper->getActiveUserRole() == 5) {
            $this->layout = 'receptionlayout.php';
        } else {
            $this->layout = 'main.php';
        }
        $searchModel = new PointsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Points model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $helper = new Helper();
        if ($helper->getActiveUserRole() == 1) {
            $this->layout = 'mainindex.php';
        } elseif ($helper->getActiveUserRole() == 2) {
            $this->layout = 'pitlayout.php';
        } elseif ($helper->getActiveUserRole() == 3) {
            $this->layout = 'accountlayout.php';
        } elseif ($helper->getActiveUserRole() == 4) {
            $this->layout = 'cctvlayout.php';
        } elseif ($helper->getActiveUserRole() == 5) {
            $this->layout = 'receptionlayout.php';
        } else {
            $this->layout = 'main.php';
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Points model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * $id member Id, $cno Counter Number, $t traansaction type (cash/Points)
     */
    public function actionCreate($id, $cno, $t) {
        $helper = new Helper();
        if ($helper->getActiveUserRole() == 1) {
            $this->layout = 'mainindex.php';
        } elseif ($helper->getActiveUserRole() == 2) {
            $this->layout = 'pitlayout.php';
        } elseif ($helper->getActiveUserRole() == 3) {
            $this->layout = 'accountlayout.php';
        } elseif ($helper->getActiveUserRole() == 4) {
            $this->layout = 'cctvlayout.php';
        } elseif ($helper->getActiveUserRole() == 5) {
            $this->layout = 'receptionlayout.php';
        } else {
            $this->layout = 'main.php';
        }
        $mid = $id;
        $model = new Points();
        $helper = new Helper();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fk_org = $helper->getActiveOrganization();
                $model->fk_user = $helper->getActiveUserId();
                $model->fk_member = $mid;
                date_default_timezone_set('Asia/Kathmandu');
                $model->date = date('Y-m-d');
                $model->fk_counter = $cno;
                $model->time = date('Y-m-d H:i:s');
                $model->points_action = $t;
            }
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success',
                        ['type' => 'success', 'icon' => 'fa fa-info', 'message' => 'Transaction Points is:' . $model->points, 'title' => 'POINTS NOTICE']);
                return $this->redirect(['ac/counter', 'id' => $cno]);
            } else {
                var_dump($model->errors);
                die;
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
                    'cno' => $cno,
        ]);
    }

    /**
     * Updates an existing Points model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $helper = new Helper();
        if ($helper->getActiveUserRole() == 1) {
            $this->layout = 'mainindex.php';  
        }elseif($helper->getActiveUserRole() == 2){
            $this->layout = 'pitlayout.php';
        }
        elseif($helper->getActiveUserRole() == 3){
            $this->layout = 'accountlayout.php';
        }elseif($helper->getActiveUserRole() == 4){
            $this->layout = 'cctvlayout.php';
        }elseif($helper->getActiveUserRole() == 5){
            $this->layout = 'receptionlayout.php';
        }else{
            $this->layout = 'main.php';
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Points model.
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
     * Finds the Points model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Points the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Points::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
