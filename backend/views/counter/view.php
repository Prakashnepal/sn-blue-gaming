<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\grid\ActionColumn;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\Tables $model */
$this->title = "All Details Of Counter " . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid border">
    <div class="card shadow bg-info">
        <h3 class="text-center text-bold "><?= Html::encode($this->title) ?></h3>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username"><strong class="text-bold">Counter value:&nbsp;&nbsp;&nbsp; </strong>54645</h3>
                            <ul class="list-group list-group-unbordered mb-3">

                                <li class="list-group-item">
                                    <b>Pit Manager</b> <a class="float-right"><?= $model->manager; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pit Supervisor</b> <a class="float-right"><?= $model->manager_sign; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b><?= $model->name; ?>&nbsp; Value</b> <a class="float-right"><?= $pitValue; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Holding Chips</b> <a class="float-right">543</a>
                                </li>

                            </ul>
                            <!--                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills border">
                                <li class="nav-item "><a class="nav-link active" href="#timeline" data-toggle="tab">Table Chips</a></li>
                                <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Top Players</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class=" tab-pane" id="activity">
                                    ACTIVITY

                                </div>
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="timeline">
                                    <div class="container-fluid">
                                        <?php
                                        echo GridView::widget([
                                            'dataProvider' => $tableChipsData,
                                            'filterModel' => $searchModel,
                                            'columns' => [
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
                                                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                                                        return Url::toRoute([$action, 'id' => $model->id]);
                                                    }
                                                ]
                                            ],
                                            'toolbar' => [
//                                                ['content' =>
//                                                    Html::a('<i class="fas fa-plus"></i>', ['create-from-table', 'id' => $iddTable], ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add New Table Chips'), 'class' => 'btn btn-success', 'onclick' => 'alert("Are you sure want to add a new CHPS!");'])
//                                                ],
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
                                            'showPageSummary' => true,
                                            'panel' => [
                                                'type' => GridView::TYPE_PRIMARY
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    Setting
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</div>
