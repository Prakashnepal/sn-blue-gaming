<?php

namespace backend\controllers;

use backend\models\StaffDetails;
use backend\models\StaffDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaffDetailsController implements the CRUD actions for StaffDetails model.
 */
class StaffDetailsController extends Controller {

    /**
     * @inheritDoc
     */
//    public $layout = 'stafflayout.php';

    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                ['access' => [
                        'class' => \yii\filters\AccessControl::class,
                        'only' => ['index', 'view', 'delete', 'update', 'signup'],
                        'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login', 'signup'],
//                        'roles' => ['?'],
//                    ],
                            [
                                'allow' => true,
                                'actions' => ['index', 'view', 'delete', 'update'],
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
     * Lists all StaffDetails models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new StaffDetailsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaffDetails model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $prov = \backend\models\Province::findOne(['id' => $model->fk_province]);
        $province = $prov['name_eng'];
        $q = \backend\models\Country::findOne(['id' => $model->fk_country]);
        $country = $q['country_name'];
        $q1 = \backend\models\Districts::findOne(['id' => $model->fk_district]);
        $district = $q1['district_eng'];
        $q2 = \backend\models\Municipals::findOne(['id' => $model->fk_municipal]);
        $municipal = $q2['mun_eng'];
        $q3 = \backend\models\Department::findOne(['id' => $model->fk_department]);
        $department = $q3['name'];
        $q4 = \backend\models\Designation::findOne(['id' => $model->fk_designation]);
        $designation = $q4['name'];
        $org = \backend\models\Organization::findOne(['id' => $model->fk_org]);

        return $this->render('view', [
                    'model' => $model,
                    'department' => $department,
                    'designation' => $designation,
                    'province' => $province,
                    'country' => $country,
                    'district' => $district,
                    'municipal' => $municipal,
                    'org' => $org
        ]);
    }

    /**
     * Creates a new StaffDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $helper = new Helper();
        $model = new StaffDetails();
        $model->generateCardNo();
        $path1 = 'AssetFiles/' . $helper->getActiveOrganization() . '/staffDetails/' . $model->emp_id . '/';
        $helper->createFolder($path1);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fk_org = $helper->getActiveOrganization();

                $model->ImageFile = \yii\web\UploadedFile::getInstance($model, 'ImageFile');
                // var_dump($model->ImageFile);die;
                if (!empty($model->ImageFile)) {
                    $model->uploadImageFile($path1);
                }
                $model->CitizenshipDoc = \yii\web\UploadedFile::getInstance($model, 'CitizenshipDoc');
                // var_dump($model->ImageFile);die;
                if (!empty($model->CitizenshipDoc)) {
                    $model->uploadIdendityDoc($path1);
                }
                if ($model->save()) {
                    \Yii::$app->getSession()->setFlash('success',
                            ['type' => 'success',
                                'icon' => 'fa fa-print',
                                'message' => $model->name . ' Created',
                                'title' => 'Create Notice']);
                    return $this->redirect(['index']);
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
     * Updates an existing StaffDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $helper = new Helper();
        $model = $this->findModel($id);
        $path1 = 'AssetFiles/' . $helper->getActiveOrganization() . '/staffDetails/' . $model->emp_id . '/';
        $helper->createFolder($path1);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->ImageFile = \yii\web\UploadedFile::getInstance($model, 'ImageFile');
            // var_dump($model->ImageFile);die;
            if (!empty($model->ImageFile)) {
                $model->uploadImageFile($path1);
            }

            $model->CitizenshipDoc = \yii\web\UploadedFile::getInstance($model, 'CitizenshipDoc');
            // var_dump($model->ImageFile);die;
            if (!empty($model->CitizenshipDoc)) {
                $model->uploadIdendityDoc($path1);
            }
            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success',
                        ['type' => 'primary',
                            'icon' => 'fa fa-print',
                            'message' => $model->name . ' Updated',
                            'title' => 'Update Notice']);
                return $this->redirect(['index']);
            } else {
                var_dump($model->errors);
                die;
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StaffDetails model.
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
     * Finds the StaffDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return StaffDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StaffDetails::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
