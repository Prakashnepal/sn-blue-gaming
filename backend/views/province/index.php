<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProvinceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Province Details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container province-index">

    <!--<h3 class="text-center"><?= Html::encode($this->title) ?></h3>-->

    <div class="row">
        <?= Html::a(Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'fk_country',
                'value' => function ($data) {
                    $command = \backend\models\Country::findOne(['id' => $data->fk_country]);
                    return $command['country_name'];
                },
                'label' => 'Country'
            ],
            'name_eng',
            'name_nep',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
