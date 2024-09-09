<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PointsSearch;
use kartik\mpdf\Pdf;

class AcController extends \yii\web\Controller {

    public $layout = 'accountlayout.php';
    public $counterNo;

    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                ['access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
                            [
                                'actions' => ['index', 'dashboard', 'counter', 'member-details', 'all-member-details', 'counter-report'],
                                'allow' => true,
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
        
        if (!empty($helper->getActiveUserPit())) {
            if ($helper->getActiveUserPit() == 1) {
                $counter = \backend\models\Counter::find()->where(['fk_org' => $helper->getActiveOrganization()])->asArray()->all();
            } else {
                $counter = \backend\models\Counter::find()->where(['id' => $helper->getActiveUserPit()])->asArray()->all();
            }
//            var_dump($counter);die;
        } else {
            $counter = \backend\models\Counter::find()->where(['fk_org' => $helper->getActiveOrganization()])->asArray()->all();
        }
        return $this->render('index', [
                    'data' => $counter,
        ]);
    }

    public function actionDashboard() {
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
        $helper = new Helper();
        $counter = \backend\models\Counter::find()->where(['fk_org' => $helper->getActiveOrganization()])->asArray()->all();
        return $this->render('index', [
                    'data' => $counter,
        ]);
    }

    public function actionCounterReport($id, $c) {
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
        $idd = explode(',', $id);

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('report', ['counterNo' => $c, 'memberID' => $idd]),
            'options' => [
            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Privacy Policy - Krajee.com',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Krajee Privacy Policy||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }

    public function actionMemberDetails($m, $c) {
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
        $helper = new Helper();
        $model = \backend\models\Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['id' => $m])->one();
        $counter = \backend\models\Counter::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['id' => $c])->asArray()->one();
        $points = \backend\models\Points::find()->where(['fk_org' => $helper->getActiveOrganization()])->andWhere(['fk_member' => $m])->all();
        $coustomerleKineko = \backend\models\Points::find()->where(['fk_member' => $m])->andWhere(['fk_org' => $helper->getActiveOrganization()])->andWhere(['points_action' => 0])->sum('points');
        $coustomerleKharchGareko = \backend\models\Points::find()->where(['fk_member' => $m])->andWhere(['fk_org' => $helper->getActiveOrganization()])->andWhere(['points_action' => 1])->sum('points');
        // $inout = \backend\models\Transactions::find()->where(['fk_member'=>$id])->limit(10)->all();
        $couurentPoints = floatval($coustomerleKineko) - floatval($coustomerleKharchGareko);

        return $this->render('member-details', [
                    'data' => $counter,
                    'points' => $points,
                    'model' => $model,
                    'couurentPoints' => $couurentPoints,
                    'c' => $c,
        ]);
    }

//     public function actionAllMemberDetails($m) {
//       $memberId = explode(',', $m);
////        var_dump($memberId);die;
//        return $this->render('', [
//            'memberId' => $memberId,
//        ]);
//        $html = $this->renderPartial('all-member-details', [
//            'model' => $memberId,
//        ]);
//        $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);
//        $mpdf->WriteHTML($html);
//        $mpdf->Output();
//        exit;
//       
//    }
    public function actionAllMemberDetails($m) {
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
        $memberId = explode(',', $m);

        return $this->render('all-member-details', [
                    'memberID' => $memberId,
                        // etc...
        ]);
    }

    public function actionCounter($id) {
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
        // $id = counter no
        $searchModelPoints = new PointsSearch(['fk_counter' => $id]);
        $dataProviderPoints = $searchModelPoints->search($this->request->queryParams);

        $searchModel = new \backend\models\MembersSearch(['status' => 1]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $counterData = \backend\models\Counter::findOne(['id' => $id]);
        // $supplier = Members::find()->all();
        $counterNo = $id;
        return $this->render('counter', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'counterNo' => $counterNo,
                    'counterData' => $counterData,
                    //'supplier'=>$supplier,
                    'searchModelPoints' => $searchModelPoints,
                    'dataProviderPoints' => $dataProviderPoints,
        ]);
    }

}
