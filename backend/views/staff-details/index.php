
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
                        'heading' => 'Staff Details...',
                        // 'heading'=>'<h3 class="panel-title"><i class="fas fa-globe"></i> Countries</h3>',
                        'type' => 'primary',
                        'before' => Html::a('<i class="fa fa-plus"></i> Add New', ['create'], ['class' => 'btn btn-default']),
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
                        GridView::PDF => [
                            'label' => Yii::t('app', 'PDF'),
                            // 'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
                            'iconOptions' => ['class' => 'text-danger'],
                            'showHeader' => true,
                            'showPageSummary' => true,
                            'showFooter' => true,
                            'showCaption' => true,
                            'filename' => Yii::t('app', 'Staff Report'),
                            'alertMsg' => Yii::t('app', 'The PDF export file will be generated for download.'),
                            'options' => ['title' => Yii::t('app', 'Portable Document Format')],
                            'mime' => 'application/pdf',
                            'config' => [
                                'mode' => 'c',
                                'format' => 'A4-L',
                                'destination' => 'D',
                                'marginTop' => 20,
                                'marginBottom' => 20,
                                'cssInline' => '.kv-wrap{padding:20px;}' .
                                '.kv-align-center{text-align:center;}' .
                                '.kv-align-left{text-align:left;}' .
                                '.kv-align-right{text-align:right;}' .
                                '.kv-align-top{vertical-align:top!important;}' .
                                '.kv-align-bottom{vertical-align:bottom!important;}' .
                                '.kv-align-middle{vertical-align:middle!important;}' .
                                '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                                '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                                '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                                'methods' => [
                                    'SetHeader' => [
                                        ['odd' => 'hhhh', 'even' => 'kkkkk']
                                    ],
                                    'SetFooter' => [
                                        ['odd' => 'bbb', 'even' => 'ddd']
                                    ],
                                ],
                                'options' => [
                                    'title' => 'Transaction',
                                    'subject' => Yii::t('app', 'Export in PDF'),
                                    'keywords' => Yii::t('app', 'krajee, grid, export, yii2-grid, pdf')
                                ],
                                'contentBefore' => '',
                                'contentAfter' => ''
                            ]
                        ],
                    ],
                    'options' => ['id' => 'griditems'],
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        // 'id',
                      
                        [
                            'attribute' => 'emp_id',
                            'headerOptions' => ['style' => 'width:12%']
                        ],
//                        'name',
                        [
                            'attribute' => 'name',
                            'headerOptions' => ['style' => 'width:50%']
                        ],
                        [
                            'attribute' => 'fk_department',
                            'value' => function ($data) {
                                $member_name = \backend\models\Department::findOne(['id' => $data->fk_department]);
                                return $member_name['name'];
                            },
                            'filter' => ArrayHelper::map(backend\models\Department::find()->where(['fk_org' => $helper->getActiveOrganization()])->all(), 'id', 'name'),
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'options' => ['prompt' => 'All', 'class' => 'text-xs'],
                                'pluginOptions' => ['allowClear' => true],
                            ],
//                            'headerOptions' => ['style' => 'width:30%']
                        ],
                        [
                            'attribute' => 'fk_designation',
                            'value' => function ($data) {
                                $member_name = \backend\models\Designation::findOne(['id' => $data->fk_designation]);
                                return $member_name['name'];
                            },
                            'filter' => ArrayHelper::map(backend\models\Designation::find()->where(['fk_org' => $helper->getActiveOrganization()])->all(), 'id', 'name'),
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'options' => ['prompt' => 'All', 'class' => 'text-xs'],
                                'pluginOptions' => ['allowClear' => true],
                            ],
//                            'headerOptions' => ['style' => 'width:30%']
                        ],
//                         'id_card_no',
                        // 'fk_org',
                        //'fk_country',
                        //'fk_province',
                        //'fk_district',
                        //'fk_municipal',
                        //'blood_group',
                        //'guardian_name',
                        //'guardian_contact',
                        //'status',
                        //'image',
                        //'contact_no',
                        //'ward_no',
                        //'sign',
                        //'dob',
                        //'citizenship_doc',
//                        [
//                            'attribute' => 'status',
//                            'value' => function ($data) {
//                                if ($data['status'] == 1) {
//
//                                    return "CHECK-IN";
//                                } else {
//                                    return "CHECK-OUT";
//                                }
//                            },
//                            'filter' => ['1' => "CHECK-IN", '0' => "CHECK-OUT"],
//                            'filterType' => GridView::FILTER_SELECT2,
//                            'filterWidgetOptions' => [
//                                'options' => ['prompt' => 'All', 'class' => 'text-xs'],
//                                'pluginOptions' => ['allowClear' => true],
//                            ],
//                            'headerOptions' => ['style' => 'width:12%']
//                        ],
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
