<?php

namespace backend\controllers;

use Yii;
use backend\models\Organization;
use backend\models\OrganizationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                [
                    'access' => [
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
                                'actions' => ['index', 'view', 'delete', 'update', 'signup'],
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
     * Lists all Organization models.
     *
     * @return string
     */
    public function actionIndex() {
        $helper = new Helper();
        $model = Organization::findOne(['id' => $helper->getActiveOrganization()]);
        $country = \backend\models\Country::findOne(['id' => $model->fk_country]);
        $province = \backend\models\Province::findOne(['id' => $model->fk_province]);
        $district = \backend\models\Districts::findOne(['id' => $model->fk_district]);
        $municipal = \backend\models\Municipals::findOne(['id' => $model->fk_municipal]);
//        var_dump($country;)
        return $this->render('index', [
                    'model' => $model,
                    'province' => $province,
                    'district' => $district,
                    'municipal' => $municipal,
                    'country' => $country,
        ]);
    }

    /**
     * Displays a single Organization model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Organization();
        $helper = new Helper();
        $user = new \backend\models\SignupForm();
        $path = 'AssetFiles/' . $helper->getActiveOrganization() . '/cardBackground/';
        $helper->createFolder($path);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $user->load($this->request->post())) {
                $model->status = 1;
                $model->fk_user = null;
                $model->created_date = date("Y/m/d");
                $model->updated_date = null;
                $model->last_updated_by = null;
                $model->LogoFile = \yii\web\UploadedFile::getInstance($model, 'LogoFile');
                if (!empty($model->LogoFile)) {
                    $model->uploadLogoFile($path);
                }

                $model->CertificateFile = \yii\web\UploadedFile::getInstance($model, 'CertificateFile');
                if (!empty($model->CertificateFile)) {
                    $model->uploadCertificateFile($path);
                }
                $model->SilverBack = \yii\web\UploadedFile::getInstance($model, 'SilverBack');
                if (!empty($model->SilverBack)) {
                    $model->uploadSilverBack($path);
                }
                $model->SilverFront = \yii\web\UploadedFile::getInstance($model, 'SilverFront');
                if (!empty($model->SilverFront)) {
                    $model->uploadSilverFront($path);
                }
                $model->GoldenBack = \yii\web\UploadedFile::getInstance($model, 'GoldenBack');
                if (!empty($model->GoldenBack)) {
                    $model->uploadGoldenBack($path);
                }
                $model->GoldenFront = \yii\web\UploadedFile::getInstance($model, 'GoldenFront');
                if (!empty($model->GoldenFront)) {
                    $model->uploadGoldenFront($path);
                }
                $model->BlackBack = \yii\web\UploadedFile::getInstance($model, 'BlackBack');
                if (!empty($model->BlackBack)) {
                    $model->uploadBlackBack($path);
                }
                $model->BlackFront = \yii\web\UploadedFile::getInstance($model, 'BlackFront');
                if (!empty($model->BlackBack)) {
                    $model->uploadBlackFront($path);
                }
                $model->WhiteBack = \yii\web\UploadedFile::getInstance($model, 'WhiteBack');
                if (!empty($model->WhiteBack)) {
                    $model->uploadWhiteBack($path);
                }
                $model->WhiteFront = \yii\web\UploadedFile::getInstance($model, 'WhiteFront');
                if (!empty($model->WhiteFront)) {
                    $model->uploadWhiteFront($path);
                }
                $model->staffID = \yii\web\UploadedFile::getInstance($model, 'staffID');
                if (!empty($model->staffID)) {
                    $model->uploadStaffCard($path);
                }

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model->save()) {
                        $org = $model->id;
                        $username = $user->username;
                        $pass = $user->password;
                        $email = $user->email;
                        if ($user->signup($org, $username, $pass, $email)) {
                            $transaction->commit();
                            Yii::$app->getSession()->setFlash('success',
                                    ['type' => 'success', 'icon' => 'fa fa-print', 'message' => 'Created...', 'title' => 'Create Notice']);
                            return $this->redirect(['index']);
                        } else {
                            $transaction->rollBack();
                            var_dump($user->errors);
                            die;
                        }
                    } else {
                        $transaction->rollBack();
                        var_dump($model->errors);
                        die;
                    }
                } catch (Exception $ex) {
                    $transaction->rollBack();
                }
            } // end of Post
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
                    'user' => $user,
        ]);
    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $helper = new Helper();
        $path = 'AssetFiles/' . $helper->getActiveOrganization() . '/cardBackground/';
        $helper->createFolder($path);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updated_date = date("Y/m/d");
            $model->last_updated_by = $helper->getActiveUserId();
            $model->LogoFile = \yii\web\UploadedFile::getInstance($model, 'LogoFile');
            if (!empty($model->LogoFile)) {
                $model->uploadLogoFile($path);
            }
            $model->CertificateFile = \yii\web\UploadedFile::getInstance($model, 'CertificateFile');
            if (!empty($model->CertificateFile)) {
                $model->uploadCertificateFile($path);
            }
            $model->SilverBack = \yii\web\UploadedFile::getInstance($model, 'SilverBack');
            if (!empty($model->SilverBack)) {
                $model->uploadSilverBack($path);
            }
            $model->SilverFront = \yii\web\UploadedFile::getInstance($model, 'SilverFront');
            if (!empty($model->SilverFront)) {
                $model->uploadSilverFront($path);
            }
            $model->GoldenBack = \yii\web\UploadedFile::getInstance($model, 'GoldenBack');
            if (!empty($model->GoldenBack)) {
                $model->uploadGoldenBack($path);
            }
            $model->GoldenFront = \yii\web\UploadedFile::getInstance($model, 'GoldenFront');
            if (!empty($model->GoldenFront)) {
                $model->uploadGoldenFront($path);
            }
            $model->BlackBack = \yii\web\UploadedFile::getInstance($model, 'BlackBack');
            if (!empty($model->BlackBack)) {
                $model->uploadBlackBack($path);
            }
            $model->BlackFront = \yii\web\UploadedFile::getInstance($model, 'BlackFront');
            if (!empty($model->BlackFront)) {
                $model->uploadBlackFront($path);
            }
            $model->WhiteBack = \yii\web\UploadedFile::getInstance($model, 'WhiteBack');
            if (!empty($model->WhiteBack)) {
                $model->uploadWhiteBack($path);
            }
            $model->WhiteFront = \yii\web\UploadedFile::getInstance($model, 'WhiteFront');
            if (!empty($model->WhiteFront)) {
                $model->uploadWhiteFront($path);
            }
            $model->staffID = \yii\web\UploadedFile::getInstance($model, 'staffID');
            if (!empty($model->staffID)) {
                $model->uploadStaffCard($path);
            }
            if ($model->save()) {
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
     * Deletes an existing Organization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSignup() {
        $helper = new Helper();
        $model = new \backend\models\SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signupFromOrg($helper->getActiveOrganization())) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Organization::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
