<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

$this->registerJs($this->render('checkbox.js'), 5);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
//$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content">

    <!-- Default box -->
    <div class="card" style="margin-top: -40px;">

        <div class="card-body">
            <?php Pjax::begin(); ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'options' => ['style' => 'font-size:12px;'],
                'resizableColumns' => true,
                'hover' => true,
                'panel' => [
                    'type' => 'danger ',
                    'heading' => 'Suspended Member Lists..',
                ],
                'showPageSummary' => false,
                'toolbar' => ['{toggleData}{export}'],
                'export' => [
                    'showConfirmAlert' => true,
                    'target' => GridView::TARGET_BLANK,
                ],
                'exportConfig' => [
                    GridView::CSV => [
                        'filename' => 'member data',
                    ],
                    GridView::EXCEL => [
                        'filename' => 'member data',
                    ],
//                    GridView::PDF => [
//                        'filename' => 'member data',
//                    ],
                ],
                'options' => ['id' => 'griditems'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    ['attribute' => 'card_no',
                        'headerOptions' => ['style' => 'width:14%']
                    ],
                    'name',
                    //'idendity_no',
                    ['attribute' => 'idendity_no',
                        'headerOptions' => ['style' => 'width:14%']
                    ],
                    [
                        'attribute' => 'fk_type',
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
                        'headerOptions' => ['style' => 'width:14%']
                    ],
                    // 'phone',
                    //'email:email',
//                    [
//                        'attribute' => 'fk_country',
//                        'value' => function ($data) {
//                            
//                            if (!empty($data->fk_country)) {
//                               $province = \backend\models\Country::findOne(['id' => $data->fk_country]);
//                            return $province['country_name'];
//                            }else{
//                                return "Not Set";
//                            }
//                        },
//                        'filter' => ArrayHelper::map(\backend\models\Country::find()->all(), 'id', 'country_name'),
//                        'filterType' => GridView::FILTER_SELECT2,
//                        'filterWidgetOptions' => [
//                            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
//                            'pluginOptions' => ['allowClear' => true],
//                        ],
//                    ],
//                    [
//                        'attribute' => 'fk_province',
//                        'value' => function ($data) {
//                            if (!empty($data->fk_province)) {
//                                $province = backend\models\Province::findOne(['id' => $data->fk_province]);
//                            return $province['name_eng'];
//                            }else{
//                                return "Not Set";
//                            }
//                        },
//                        'filter' => ArrayHelper::map(backend\models\Province::find()->all(), 'id', 'name_eng'),
//                        'filterType' => GridView::FILTER_SELECT2,
//                        'filterWidgetOptions' => [
//                            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
//                            'pluginOptions' => ['allowClear' => true],
//                        ],
//                    ],
//                    [
//                        'attribute' => 'fk_district',
//                        'value' => function ($data) {
//                            
//                            if (!empty($data->fk_district)) {
//                              $province = backend\models\Districts::findOne(['id' => $data->fk_district]);
//                            return $province['district_eng'];
//                            }else{
//                                return "Not Set";
//                            }
//                        },
//                        'filter' => ArrayHelper::map(backend\models\Districts::find()->all(), 'id', 'district_eng'),
//                        'filterType' => GridView::FILTER_SELECT2,
//                        'filterWidgetOptions' => [
//                            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
//                            'pluginOptions' => ['allowClear' => true],
//                        ],
//                    ],
//                    [
//                        'attribute' => 'fk_municipal',
//                        'value' => function ($data) {
//                            
//                             if (!empty($data->fk_municipal)) {
//                             $province = backend\models\Municipals::findOne(['id' => $data->fk_municipal]);
//                            return $province['mun_eng'];
//                            }else{
//                                return "Not Set";
//                            }
//                        },
//                        'filter' => ArrayHelper::map(backend\models\Municipals::find()->all(), 'id', 'mun_eng'),
//                        'filterType' => GridView::FILTER_SELECT2,
//                        'filterWidgetOptions' => [
//                            'options' => ['prompt' => 'All', 'class' => 'text-xs'],
//                            'pluginOptions' => ['allowClear' => true],
//                        ],
//                    ],
                    //'fk_city',
                    //'address:ntext',
                    //'status',
                    //'created_date',
                    //'update_date',
                    //'card_print_count',
                    //'fk_org',
                    //'image',
                    //'remarks:ntext',
                    //'created_by',
                    //'member_year',
                   
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{revoke}',
                        'buttons' => [
                            'revoke' => function ($url, $model) {
                                $t = 'index.php?r=members/revoke&id=' . $model->id;
                                return \yii\helpers\Html::a('<span class="fa fa-trash"></span>',$url, [ 'class' => 'btn btn-default btn-xs','title'=>'UN-BLOCK']);
                            },
                        ],
                    ]
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