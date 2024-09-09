<?php

namespace backend\controllers;


use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
//    public $layout = 'mainindex.php';
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','dashboard','table','table2'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
       date_default_timezone_set('Asia/Kathmandu');
        $helper = new Helper();
        $totalCheckInCustomer = \backend\models\Transactions::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['status' => 1])->count();
        $inout = \backend\models\Transactions::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['status' => 1])->andWhere(['date' => date('Y-m-d')])->count();
        $mno = \backend\models\Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->count();
       
        return $this->render('index', [
             'inout' => $inout,
                    'total' => $totalCheckInCustomer,
                    'mno' => $mno,       
        ]);
    }
    public function actionDashboard() {
        date_default_timezone_set('Asia/Kathmandu');
        $helper = new Helper();
        $totalCheckInCustomer = \backend\models\Transactions::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['status' => 1])->count();
        $inout = \backend\models\Transactions::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['status' => 1])->andWhere(['date' => date('Y-m-d')])->count();
        $mno = \backend\models\Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->count();
        // for barchart
      //  $sql = ""
        return $this->render('dashboard', [
                    'inout' => $inout,
                    'total' => $totalCheckInCustomer,
                    'mno' => $mno,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';

        $model = new \common\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionTable() {
         return $this->render('table');
    }
     public function actionTable2() {
         return $this->render('table2');
    }

}
