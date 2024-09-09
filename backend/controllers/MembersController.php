<?php

namespace backend\controllers;

use Yii;
use backend\models\Members;
use backend\models\MembersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MembersController implements the CRUD actions for Members model.
 */
class MembersController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                ['access' => [
                        'class' => \yii\filters\AccessControl::class,
                        'only' => ['index', 'view', 'delete', 'update', 'update-status', 'suspended', 'revoke', 'printcount'],
                        'rules' => [
                            [
                                'allow' => true,
                                'actions' => ['index', 'view', 'delete', 'update', 'update-status', 'revoke', 'suspended', 'printcount'],
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
     * Lists all Members models.
     *
     * @return string
     */
    public function actionPrintcount($id) {
        $model = $this->findModel($id);
        if (!empty($model->member_card_print_count)) {
            $count = $model->member_card_print_count;
            $model->member_card_print_count = $count + 1;
        } else {
            $model->member_card_print_count = 1;
        }
        $model->save();
    }

    public function actionIndex() {
        $helper = new Helper();
//        if ($helper->getActiveUserRole() == 1) {
//            $this->layout = 'main.php';
//        } elseif ($helper->getActiveUserRole() == 2) {
//            $this->layout = 'pitlayout.php';
//        } elseif ($helper->getActiveUserRole() == 3) {
//            $this->layout = 'accountlayout.php';
//        } elseif ($helper->getActiveUserRole() == 4) {
//            $this->layout = 'cctvlayout.php';
//        } elseif ($helper->getActiveUserRole() == 5) {
//            $this->layout = 'receptionlayout.php';
//        } else {
//            $this->layout = 'mainindex.php';
//        }
//        staatus value 1 = active and 0 = Sespended user
        $searchModel = new MembersSearch(['status' => 1]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                        
        ]);
    }

    public function actionUpdateStatus($id) {
        $helper = new Helper();
//        if ($helper->getActiveUserRole() == 1) {
//            $this->layout = 'main.php';
//        } elseif ($helper->getActiveUserRole() == 2) {
//            $this->layout = 'pitlayout.php';
//        } elseif ($helper->getActiveUserRole() == 3) {
//            $this->layout = 'accountlayout.php';
//        } elseif ($helper->getActiveUserRole() == 4) {
//            $this->layout = 'cctvlayout.php';
//        } elseif ($helper->getActiveUserRole() == 5) {
//            $this->layout = 'receptionlayout.php';
//        } else {
//            $this->layout = 'mainindex.php';
//        }
        $helper = new Helper();
        $model = new \backend\models\Transactions();
        $model->fk_org = $helper->getActiveOrganization();
        $model->fk_member = $id;
        $model->purpose = "FOR ENTERTAINMENT";
        date_default_timezone_set("Asia/Kathmandu");
        $model->date = date('Y-m-d');
        $model->time = date('h:i:s');
        $model->remarks = null;
        $model->created_by = $helper->getActiveUserId();
        $model->status = 1;
        if ($model->save()) {
            Yii::$app->getSession()->setFlash('success',
                    ['type' => 'success',
                        'icon' => 'fa fa-print',
                        'message' => ' CHECK-IN SUCCESSFULLY',
                        'title' => 'User Notice']);
            return $this->redirect(['index']);
        } else {
            var_dump($model->errors);
            die;
        }
    }

    public function actionSuspended() {
        $helper = new Helper();
//        if ($helper->getActiveUserRole() == 1) {
//            $this->layout = 'main.php';
//        } elseif ($helper->getActiveUserRole() == 2) {
//            $this->layout = 'pitlayout.php';
//        } elseif ($helper->getActiveUserRole() == 3) {
//            $this->layout = 'accountlayout.php';
//        } elseif ($helper->getActiveUserRole() == 4) {
//            $this->layout = 'cctvlayout.php';
//        } elseif ($helper->getActiveUserRole() == 5) {
//            $this->layout = 'receptionlayout.php';
//        } else {
//            $this->layout = 'mainindex.php';
//        }
        $searchModel = new MembersSearch(['status' => 0]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('suspended', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionVisitors() {
        
    }

    /**
     * Displays a single Members model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $helper = new Helper();
//        if ($helper->getActiveUserRole() == 1) {
//            $this->layout = 'main.php';
//        } elseif ($helper->getActiveUserRole() == 2) {
//            $this->layout = 'pitlayout.php';
//        } elseif ($helper->getActiveUserRole() == 3) {
//            $this->layout = 'accountlayout.php';
//        } elseif ($helper->getActiveUserRole() == 4) {
//            $this->layout = 'cctvlayout.php';
//        } elseif ($helper->getActiveUserRole() == 5) {
//            $this->layout = 'receptionlayout.php';
//        } else {
//            $this->layout = 'mainindex.php';
//        }
        $model = $this->findModel($id);
        $helper = new Helper();
        $CollectionPoint = \backend\models\Points::find()->where(['fk_member' => $id])->andWhere(['fk_org' => $helper->getActiveOrganization()])->andWhere(['points_action' => 0])->sum('points');
        $buyPoint = \backend\models\Points::find()->where(['fk_member' => $id])->andWhere(['fk_org' => $helper->getActiveOrganization()])->andWhere(['points_action' => 1])->sum('points');
        // $inout = \backend\models\Transactions::find()->where(['fk_member'=>$id])->limit(10)->all();
        $points = $buyPoint - $CollectionPoint;
        $municipal = \backend\models\Municipals::findOne(['id' => $model->fk_municipal]);
        $district = \backend\models\Districts::findOne(['id' => $model->fk_district]);
        $province = \backend\models\Province::findOne(['id' => $model->fk_province]);
        $member_type = \backend\models\MemberType::findOne(['id' => $model->fk_type]);
        $country = \backend\models\Nationality::findOne(['id' => $model->fk_nationality]);
        $city = \backend\models\Cities::findOne(['id' => $model->fk_city]);
        $org = \backend\models\Organization::findOne(['id' => $model->fk_org]);
        $checkinout = \backend\models\Transactions::find()->where(['fk_member' => $id])->andWhere(['fk_org' => $helper->getActiveOrganization()])->orderBy(['id' => SORT_DESC])->one();
//        $led = \backend\modules\account\models\Ledger::findAll(['fk_member' => $model->id]);
//        var_dump($helper->getActiveOrganization());die;
        return $this->render('view', [
                    'checkinout' => $checkinout,
                    //'inout'=>$inout,
                    'points' => $points,
                    'model' => $model,
                    'mun' => $municipal,
                    'city' => $city,
                    'dis' => $district,
                    'country' => $country,
                    'type' => $member_type,
                    'province' => $province,
                    'org' => $org,
        ]);
    }

    /**
     * Creates a new Members model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $helper = new Helper();
//        if ($helper->getActiveUserRole() == 1) {
//            $this->layout = 'main.php';
//        } elseif ($helper->getActiveUserRole() == 2) {
//            $this->layout = 'pitlayout.php';
//        } elseif ($helper->getActiveUserRole() == 3) {
//            $this->layout = 'accountlayout.php';
//        } elseif ($helper->getActiveUserRole() == 4) {
//            $this->layout = 'cctvlayout.php';
//        } elseif ($helper->getActiveUserRole() == 5) {
//            $this->layout = 'receptionlayout.php';
//        } else {
//            $this->layout = 'mainindex.php';
//        }
        $model = new Members();
//        var_dump($model->getPrimaryKey());die;
        $helper = new Helper();
        $path = 'AssetFiles/' . $helper->getActiveOrganization() . '/members/images/';
        $path1 = 'AssetFiles/' . $helper->getActiveOrganization() . '/members/doc/';
        $helper->createFolder($path1);
        $helper->createFolder($path);
        define('UPLOAD_DIR', $path);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = 1;
                $model->generateCardNo();
                $model->created_by = $helper->getActiveUserId();
                $model->created_date = date("Y/m/d");
//                var_dump( $model->created_date);die;
                $model->fk_org = $helper->getActiveOrganization();
                $model->ImageFile = \yii\web\UploadedFile::getInstance($model, 'ImageFile');
                // var_dump($model->ImageFile);die;
                if (!empty($model->ImageFile)) {
                    $model->uploadImage($path);
                }
                $model->IdendityDoc = \yii\web\UploadedFile::getInstance($model, 'IdendityDoc');
                if (!empty($model->IdendityDoc)) {
                    $model->uploadIdendityDoc($path1);
                }
                $model->IdendityDocBack = \yii\web\UploadedFile::getInstance($model, 'IdendityDocBack');
                if (!empty($model->IdendityDocBack)) {
                    $model->uploadIdendityDocBack($path1);
                }
                if (!empty($model->photo_from_camera)) {

                    $image_parts2 = explode(";base64,", $model->photo_from_camera);
                    $image_type_aux2 = explode("image/", $image_parts2[0]);
                    $image_type2 = $image_type_aux2[1];
                    $image_base64_2 = base64_decode($image_parts2[1]);
                    $file2 = UPLOAD_DIR . uniqid() . '.png';
                    file_put_contents($file2, $image_base64_2);
                    $model->image = $file2;
//                    var_dump($file2);
//                    die;
                }
                // Ledger create start
                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success',
                            ['type' => 'success',
                                'icon' => 'fa fa-print',
                                'message' => $model->name . ' Created',
                                'title' => 'Create Notice']);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        } // end is post

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionPrintData($id) {
        $member = Members::findOne(['id' => $id]);
    }

    /**
     * Updates an existing Members model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $helper = new Helper();
//        if ($helper->getActiveUserRole() == 1) {
//            $this->layout = 'main.php';
//        } elseif ($helper->getActiveUserRole() == 2) {
//            $this->layout = 'pitlayout.php';
//        } elseif ($helper->getActiveUserRole() == 3) {
//            $this->layout = 'accountlayout.php';
//        } elseif ($helper->getActiveUserRole() == 4) {
//            $this->layout = 'cctvlayout.php';
//        } elseif ($helper->getActiveUserRole() == 5) {
//            $this->layout = 'receptionlayout.php';
//        } else {
//            $this->layout = 'mainindex.php';
//        }
        $helper = new Helper();
        $model = $this->findModel($id);
        $path = 'AssetFiles/' . $helper->getActiveOrganization() . '/members/images/';
        $path1 = 'AssetFiles/' . $helper->getActiveOrganization() . '/members/doc/';
        $helper->createFolder($path1);
        $helper->createFolder($path);
        define('UPLOAD_DIR', $path);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->ImageFile = \yii\web\UploadedFile::getInstance($model, 'ImageFile');
            if (!empty($model->ImageFile)) {
                $model->uploadImage($path);
            }
            $model->IdendityDoc = \yii\web\UploadedFile::getInstance($model, 'IdendityDoc');
            if (!empty($model->IdendityDoc)) {
                $model->uploadIdendityDoc($path1);
            }
            $model->IdendityDocBack = \yii\web\UploadedFile::getInstance($model, 'IdendityDocBack');
            if (!empty($model->IdendityDocBack)) {
                $model->uploadIdendityDocBack($path1);
            }
            if (!empty($model->photo_from_camera)) {

                $image_parts2 = explode(";base64,", $model->photo_from_camera);
                $image_type_aux2 = explode("image/", $image_parts2[0]);
                $image_type2 = $image_type_aux2[1];
                $image_base64_2 = base64_decode($image_parts2[1]);
                $file2 = UPLOAD_DIR . uniqid() . '.png';
                file_put_contents($file2, $image_base64_2);
                $model->image = $file2;
//                var_dump($file2);
//                die;
            }
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success',
                        ['type' => 'success',
                            'icon' => 'fa fa-print',
                            'message' => $model->name . ' Updated',
                            'title' => 'Create Notice']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Members model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->status = 0;
        if ($model->save()) {
            Yii::$app->getSession()->setFlash('success',
                    ['type' => 'success',
                        'icon' => 'fa fa-print',
                        'message' => ' Suspended',
                        'title' => 'User Notice']);
            return $this->redirect(['index']);
        } else {
            var_dump($model->errors);
            die;
        }
    }

    public function actionRevoke($id) {
        $model = $this->findModel($id);
        $model->status = 1;
        if ($model->save()) {
            Yii::$app->getSession()->setFlash('success',
                    ['type' => 'success',
                        'icon' => 'fa fa-print',
                        'message' => ' Member Revoked',
                        'title' => 'User Notice']);
            return $this->redirect(['index']);
        } else {
            var_dump($model->errors);
            die;
        }
    }

    public function actionMunicipals() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \backend\models\Municipals::find()->where(['fk_district' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['mun_eng']];
                    if ($i == 0) {
                        $selected = $account['id'];
                    }
                }
                // Shows how you can preselect a value
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * Finds the Members model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Members the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Members::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
