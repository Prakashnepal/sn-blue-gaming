<?php

use backend\models\TableChips;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\TableChipsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = Yii::t('app', 'Table Chips details');
$this->params['breadcrumbs'][] = $this->title;
$griditem = [
    ['class' => 'yii\grid\SerialColumn'],
    'name',
    'value',
    'qty',
    [
        'header' => 'Amount',
        'pageSummary' => true,
        'value' => function ($model) {
            $data = $model->value * $model->qty;
//        var_dump($data);die;
            return empty($data) ? '00.00' : $data;
        },
        'format' => 'decimal'
    ],
//            'image',
//            'status',
    //'fk_user',
    //'fk_org',
    ['label' => 'Table',
        'attribute' => 'fk_table',
        'value' => function ($model, $index, $widget) {
            return $model->fkTable->name;
        },
        'filter' => ArrayHelper::map(backend\models\Tables::find()->all(), 'id', 'name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
            'pluginOptions' => ['allowClear' => true],
        ],
    ],
    //'created_date',
    //'remarks:ntext',
    [
        'class' => ActionColumn::className(),
        'template' => ' {update}',
        'urlCreator' => function ($action, TableChips $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ]
];
$r = Html::encode($this->title);
$ff = '<div class="container" style="background-color:#ebf0ec"><h3 class="text-center">' . $r . ' </h3></div>';
?>
<div class="table-chips-index">



    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $griditem,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => $ff, 'options' => ['colspan' => 7, 'class' => 'text-center warning']],
                ],
                'options' => ['class' => 'skip-export'] // remove this row from export
            ]
        ],
        'toolbar' => [
            ['content' =>
                Html::a('<i class="fas fa-plus"></i>', ['create'], ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add New Table Chips'), 'class' => 'btn btn-success', 'onclick' => 'alert("Are you sure want to add a new CHPS!");']) . ' ' .
                Html::a('<i class="fas fa-redo"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Refresh')])
            ],
            '{export}',
//            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
//    'floatHeaderOptions' => ['top' => $scrollingTop],
        'showPageSummary' => true,
        'layout' => "{items}\n{pager}{summary}",
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);
    ?>


    <?php Pjax::end(); ?>

</div>
