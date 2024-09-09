<?php

namespace backend\controllers;

use backend\models\Tables;
use backend\models\TablesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\Helper;
use backend\models\TableChipsSearch;
/**
 * TablesController implements the CRUD actions for Tables model.
 */
class TablesController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                [
                    'access' => [
                        'class' => \yii\filters\AccessControl::class,
                        'only' => ['index', 'view', 'delete', 'update'],
                        'rules' => [
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
     * Lists all Tables models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new TablesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tables model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
//        $chgips = \backend\models\TableChips::find()->where(['fk_table'=>$id])->andWhere(['fk_org'=> Helper::getActiveOrganization()])->asArray()->all();
////        var_dump($chgips);die;
         $searchModelTableChips = new TableChipsSearch(['fk_table'=>$id]);
        $dataProvidertablechips = $searchModelTableChips->search($this->request->queryParams);
        return $this->render('view', [
                    'model' => $this->findModel($id),
            'tableChipsData'=>$dataProvidertablechips,
            'tableChipsDataSearch'=>$searchModelTableChips,
            'iddTable'=>$id,
        ]);
    }
    
    
     public function actionCreateFromTable($id) {
        $model = new \backend\models\TableChips();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fk_user = Helper::getActiveUserId();
                $model->fk_org = Helper::getActiveOrganization();
                $model->status = 1;
                $model->fk_table = $id; // id id table id
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $id]);
                } else {
                    var_dump($model->errors);
                    die;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-from-table', [
                    'model' => $model,
            'tableid'=>$id,
        ]);
    }

    /**
     * Creates a new Tables model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Tables();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fk_user = Helper::getActiveUserId();
                $model->fk_org = Helper::getActiveOrganization();
//                $model->fk_user = Helper::getActiveUserId();
                $model->status = 1;

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Tables model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing Tables model.
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
     * Finds the Tables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tables::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
