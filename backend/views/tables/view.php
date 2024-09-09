<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\grid\ActionColumn;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\Tables $model */
$this->title = "All Details Of Table " . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container border">
    <div class="card shadow bg-info m-0">
        <h3 class="text-center text-bold "><?= Html::encode($this->title) ?></h3>
    </div>
    <section class="content mt-0">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username"><strong class="text-bold">Table value:&nbsp;&nbsp;&nbsp; </strong><?= $model->value; ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Current Pit</b> <a class="float-right"><?= $model->fkCounter->name; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pit Manager</b> <a class="float-right"><?= $model->fkCounter->manager; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pit Supervisor</b> <a class="float-right"><?= $model->fkCounter->manager_sign; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Current Value</b> <a class="float-right">1,322</a>
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
                <div class="col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-header ">
                            <ul class="nav nav-pills border ">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Table Chips</a></li>
                                <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Top Players</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class=" tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                            <span class="username">
                                                <a href="#">Jonathan Burke Jr.</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">Shared     - 7:30 PM today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore the hate as they create awesome
                                            tools to help create filler text for everyone from bacon lovers
                                            to Charlie Sheen fans.
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                            <span class="float-right">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                                </a>
                                            </span>
                                        </p>

                                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                    </div>
                                    <!-- /.post -->


                                </div>
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="timeline">
                                    <div class="container-fluid">
                                        <?php
                                        echo GridView::widget([
                                            'dataProvider' => $tableChipsData,
//                                            'filterModel' => $tableChipsDataSearch,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                'name',
                                                'value',
                                                'qty',
                                                [
                                                    'header' => 'Amount',
                                                    'pageSummary' => true,
                                                    'value' => function ($model1) {
                                                        $data = $model1->value * $model1->qty;
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
                                                    'value' => function ($model1, $index, $widget) {
                                                        return $model1->fkTable->name;
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
//                                                [
//                                                    'class' => 'kartik\grid\ActionColumn',
////                                                    'dropdown' => true,
////                                                    'vAlign' => 'middle',
//                                                    'template'=>'{view}',
//                                                    'urlCreator' => function ($action, $model, $key, $index) {
//                                                        return '#';
//                                                    },
//                                                    'updateOptions' => ['title' => 'dfhgjdkfghfdjkghdfkj', 'data-toggle' => 'tooltip'],
//                                                 
//                                                ],
                                            ],
                                            'toolbar' => [
                                                ['content' =>
                                                    Html::a('<i class="fas fa-plus"></i>', ['create-from-table', 'id' => $iddTable], ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add New Table Chips'), 'class' => 'btn btn-success', 'onclick' => 'alert("Are you sure want to add a new CHPS!");'])
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
