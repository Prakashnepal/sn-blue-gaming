<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJs($this->render('checkbox.js'), 5);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'member details');
$this->params['breadcrumbs'][] = $this->title;
$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    // 'id',
    ['attribute' => 'card_no',
        'contentOptions' => ['class' => 'm-0 p-0 text-center'],
        'headerOptions' => ['class' => 'text-center', 'style' => 'width:14%'],
        'filterOptions' => ['class' => 'input-sm']
    ],
    'name',
    //'idendity_no',
    ['attribute' => 'idendity_no',
        'contentOptions' => ['class' => 'm-0 p-0 text-center'],
        'headerOptions' => ['class' => 'text-center', 'style' => 'width:19%']
    ],
    [
        'attribute' => 'status',
        'contentOptions' => ['class' => 'm-0 p-0 text-center'],
        'format' => 'raw',
        'value' => function ($model, $key, $index, $column) {

            return Html::a(
                    'CHECK-IN<i class="fa fa-euro btn"></i>',
                    Url::to(['members/update-status', 'id' => $model->id]),
                    ['class' => 'button btn btn-default btn-sm'],
                    ['data-confirm' => 'Are You Sure..?'],
//                                    [
//                                        'id' => 'grid-custom-button',
//                                        'data-pjax' => true,
//                                        'action' => Url::to(['members/update-status', 'id' => $model->id]),
//                                        'class' => 'button btn btn-default btn-sm',
//                                    ]
            );
        },
        'headerOptions' => ['class' => 'text-center', 'style' => 'width:15%']
    ],
    [
        'attribute' => 'fk_type',
        'contentOptions' => ['class' => 'm-0 p-0 text-center'],
        'value' => function ($data) {
            $province = backend\models\MemberType::findOne(['id' => $data->fk_type]);
            return $province['type'];
        },
        'filter' => ArrayHelper::map(backend\models\MemberType::find()->all(), 'id', 'type'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
            'pluginOptions' => ['allowClear' => true],
        ],
        'headerOptions' => ['class' => 'text-center']
    ],
    ['class' => 'yii\grid\ActionColumn',
        'headerOptions' => ['class' => 'text-center', 'style' => 'width:6%']
    ],
//                    [
//                        'class' => 'yii\grid\CheckboxColumn',
//                        'checkboxOptions' => function ($model) {
//                            return [
//                        'value' => $model->id,
//                            ];
//                        },
//                    ],
];
?>




<!-- Default box -->
<div class="card" >


    <?php Pjax::begin(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'bootstrap' => true,
        'bordered' => true,
        'layout' => "{items}\n{pager}{summary}",
        'pjax' => true,
        'tableOptions' => ['class' => 'table-sm'],
        'responsiveWrap' => true,
        'floatFooter' => true,
        'footerContainer' => ['class' => 'kv-table-footer', 'style' => 'bottom: 50px'],
        'rowOptions' => ['class' => 'm-0 p-0'],
        'headerRowOptions' => ['style' => 'color:blue;font-size:13px;'],
        'options' => ['id' => 'griditems'],
        'columns' => $columns,
      
    ]);
    ?>


    <?php Pjax::end(); ?>

</div>
<!-- /.card -->
