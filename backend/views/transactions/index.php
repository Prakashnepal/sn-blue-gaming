<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

$helper = new backend\controllers\Helper();
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
//$this->params['breadcrumbs'][] = $this->title;
//var_dump()
?>

<div class="section">
    <div class="card">
        <div class="card-body">
            <div class="transactions-index">

            <!--    <h1><?= Html::encode($this->title) ?></h1>-->

<!--                <p>
                <?= Html::a(Yii::t('app', 'Create Transactions'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>-->

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>
                <div class="row">

                </div>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsive' => true,
                    'options' => ['style' => 'font-size:10px;'],
                    'resizableColumns' => true,
                    'hover' => true,
                    'panel' => [
                        'heading' => 'VISITORS CHECK-IN/CHECK-OUT REPORT',
                        // 'heading'=>'<h3 class="panel-title"><i class="fas fa-globe"></i> Countries</h3>',
                        'type' => 'primary',
//                        'before' => Html::a('<i class="fa fa-plus"></i> Add New', ['create'], ['class' => 'btn btn-default']),
//                        'after' => Html::a('<i class="fas fa-redo"></i> Reset', ['index'], ['class' => 'btn btn-info pull-right']),
                        'footer' => false
                    ],
                    'showPageSummary' => true,
                    'toolbar' => [
                        '{toggleData}{export}'],
                    'export' => [
                        'showConfirmAlert' => true,
                        'target' => GridView::TARGET_BLANK,
                    ],
                    'exportConfig' => [
                        GridView::CSV => [
                            'filename' => 'InOut Report',
                        ],
                        GridView::EXCEL => [
                            'filename' => 'InOut Report',
                        ],
                    ],
                    'options' => ['id' => 'griditems'],
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'fk_member',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $member_name = \backend\models\Members::findOne(['id' => $data->fk_member]);
                                return $member_name['name'];
//                                Html::a($data['name'], ['members/view']]);
                                Html::a($member_name['name'], ['members/view', 'id' => $data['id']]);
                            },
                            'filter' => ArrayHelper::map(backend\models\Members::find()->where(['fk_org' => $helper->getActiveOrganization()])->all(), 'id', 'name'),
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'options' => ['prompt' => 'All', 'class' => 'text-xs'],
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'headerOptions' => ['style' => 'width:30%']
                        ],
//                        [
//                            'label' => 'Address',
//                            'value' => function ($data) {
//                                $member = \backend\models\Members::findOne(['id' => $data->fk_member]);
//
//                                $country = \backend\models\Country::findOne(['id' => $member->fk_country]);
//                                $state = \backend\models\Province::findOne(['id' => $member->fk_province]);
//                                $district = \backend\models\Districts::findOne(['id' => $member->fk_district]);
//                                $mun = backend\models\Municipals::findOne(['id' => $member->fk_municipal]);
//                                $address = empty($mun['mun_eng']) ? '' : $mun['mun_eng'] . ', ' .
//                                        empty($district['district_eng']) ? '' : $district['district_eng'] . ' ' .
//                                        empty($state['name_eng']) ? '' : $state['name_eng'] . ' ' .
//                                        empty($country['country_name']) ? '' : $country['country_name'];
//
//                                return $address;
//                            }
//                        ],
//                        'date',
                        [
                            'attribute' => 'date',
                            // 'value' => 'order_date',
                            'format' => 'raw',
                            'label' => "Date",
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'options' => ['placeholder' => 'Select a Day', 'autocomplete' => 'off'],
                                'name' => 'TransactionsSearch[date]',
                                'value' => ArrayHelper::getValue($_GET, "TransactionsSearch.date"),
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ])
                        ],
                        'time',
                        [
                            'attribute' => 'status',
                            'value' => function ($data) {
                                if ($data['status'] == 1) {

                                    return "CHECK-IN";
                                } else {
                                    return "CHECK-OUT";
                                }
                            },
                            'filter' => ['1' => "CHECK-IN", '0' => "CHECK-OUT"],
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'options' => ['prompt' => 'All', 'class' => 'text-xs'],
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'headerOptions' => ['style' => 'width:12%']
                        ],
                        //'created_by',
                        // 'purpose:ntext',
                        // 'remarks:ntext',
                        //  ['class' => 'kartik\grid\ActionColumn'],
                        ['class' => ActionColumn::className(), 'template' => '{view}']
                    ],
                ]);
                ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>