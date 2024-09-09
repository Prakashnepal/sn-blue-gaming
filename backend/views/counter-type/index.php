<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CounterTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-type-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

<!--    <p>
        <?= Html::a(Yii::t('app', 'Create Counter Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type',
            'remarks:ntext',
            'created_at',
            //'created_by',
            //'fk_org',
          ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],  
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
