
<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\mpdf\Pdf;

$helper = new backend\controllers\Helper();

$this->registerJs($this->render('checkbox.js'), 5);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
//$this->params['breadcrumbs'][] = $this->title;
$gridcolumns = [
    ['class' => 'yii\grid\SerialColumn'],
//                    [
//                        'class' => 'yii\grid\CheckboxColumn',
//                        'checkboxOptions' => function ($model) {
//                            return [
//                        'value' => $model->id,
//                            ];
//                        },
//                    ],
    [
        'attribute' => 'fk_counter',
        'label' => 'Counter',
        'value' => function ($data) {
            $user_name = \backend\models\Counter::findOne(['id' => $data->fk_counter]);
            return $user_name['code'];
        },
        'filter' => ArrayHelper::map(\backend\models\Counter::find()->Where(['fk_org' => $helper->getActiveOrganization()])->all(), 'id', 'code'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
            'pluginOptions' => ['allowClear' => true],
        ],
        'headerOptions' => ['style' => 'width:10%']
    ],
    [
        'attribute' => 'points_action',
        'label' => 'Action',
        'value' => function ($data) {
            if ($data['points_action'] == 1) {
                return "DEBIT";
            } else {
                return "CREDIT";
            }
        },
        'filter' => ['1' => 'DEBIT', '0' => 'CREDIT'],
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
            'pluginOptions' => ['allowClear' => true],
        ],
        'headerOptions' => ['style' => 'width:10%']
    ],
    [
        'attribute' => 'net_points',
        'label' => 'Type',
        'filter' => ['POINTS' => 'POINTS', 'CASH' => 'CASH'],
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
            'pluginOptions' => ['allowClear' => true],
        ],
        'headerOptions' => ['style' => 'width:10%']
    ],
    [
        'attribute' => 'fk_member',
        'label' => 'Member',
        'value' => function ($data) {

            $member_name = \backend\models\Members::findOne(['id' => $data->fk_member]);
            return $member_name['name'];
        },
        'filter' => ArrayHelper::map(\backend\models\Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->all(), 'id', 'name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
            'pluginOptions' => ['allowClear' => true],
        ],
        'headerOptions' => ['style' => 'width:32%']
    ],
    ['attribute' => 'points',
        'headerOptions' => ['style' => 'width:6%']
    ],
    // 'date',
    'time:datetime',
    [
        'attribute' => 'fk_user',
        'label' => 'Entry By',
        'value' => function ($data) {
            $user_name = \backend\models\User::findOne(['id' => $data->fk_user]);
            return $user_name['username'];
        }
    ],
    ['class' => 'yii\grid\ActionColumn'],
];
?>


<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <?php // echo  Html::button(Yii::t('app', 'Prints Member Ledger'), ['class' => 'btn btn-default btn-sm pull-right', 'id' => 'memberledger'])  ?>

        </div>
        <div class="card-body">
            <?php Pjax::begin(); ?>

            <?=
            GridView::widget(['dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridcolumns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'beforeHeader' => [
                    [
                        'columns' => [
                            ['content' => '<div class="row bg-danger"><p style="overflow:hidden">dsfshdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfshdfvsdfgsdhfvbd</p></div>', 'options' => ['colspan' => 9, 'class' => 'text-center warning']],
//                            ['content' => 'Header Before 2', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
//                            ['content' => 'Header Before 3', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                        ],
                        'options' => ['class' => ''] // remove this row from export
                    ]
                ],
                'toolbar' => [
                    ['content' =>
                        Html::button('<i class="fa fa-plus" aria-hidden="true"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
                        Html::a('<i class="fa fa-redo" aria-hidden="true"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                    ],
                    '{export}',
                    '{toggleData}'
                ],
                'pjax' => true,
                'bordered' => true,
                'striped' => false,
                'condensed' => false,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => true,
//                'floatHeaderOptions' => ['top' => $scrollingTop],
                'showPageSummary' => true,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY
                ],
            ]);
            ?>


            <?php Pjax::end(); ?>
        </div>

        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->