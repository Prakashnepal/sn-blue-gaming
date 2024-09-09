<?php

use backend\models\Counter;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\CounterSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = Yii::t('app', 'Counters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <?= Html::a(Yii::t('app', 'NEW'), ['create'], ['class' => 'btn btn-success float-right']) ?>




    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->name . '-' . $data->code;
                }
            ],
//            'code',
            ['label' => 'Type', 'attribute' => 'fk_type', 'value' => function ($model, $index, $widget) {
                    return $model->fkType->type;
                }],
            //'fk_user',
            //'created_date',
            //'remarks:ntext',
            //'status',
            'manager',
            'manager_sign',
            [
                'header' => 'Pit Value',
                'value' => function ($model) {
                    return \backend\controllers\Helper::getPitvalue($model->id);
                },'format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Counter $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
