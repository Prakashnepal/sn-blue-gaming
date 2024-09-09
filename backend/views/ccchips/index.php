<?php

use backend\models\Ccchips;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\CcchipsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = Yii::t('app', 'Cash Chips Details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccchips-index">

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <p class="float-right">
        <?= Html::a(Yii::t('app', 'NEW'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
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
                        'format'=>'decimal'
            ],
//            'fk_user',
//            'fk_org',
            //'remarks',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ccchips $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
