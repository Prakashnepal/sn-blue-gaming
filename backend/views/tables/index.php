<?php

use backend\models\Tables;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\TablesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tables');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tables-index">

    <h1 class="text-center "><?= Html::encode($this->title) ?></h1>

    
        <?= Html::a(Yii::t('app', 'NEW'), ['create'], ['class' => 'btn btn-primary float-right']) ?>
    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'name',
            'code',
           
            [
                'attribute'=>'value',
                 'format'=>'decimal',
                'pageSummary'=>true,
            ],
            
             ['label' => 'COUNTER', 'attribute' => 'fk_counter', 'value' => function ($model, $index, $widget) {
                    return $model->fkCounter->name;
                }],
            //'fk_user',
            //'fk_org',
            //'status',
            //'remarks:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tables $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
