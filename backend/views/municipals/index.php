<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MunicipalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Local-Government');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container municipals-index">

   
    <p>
        <?= Html::a(Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
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
            
                        [
                'attribute' => 'fk_province',
                'value' => function ($data) {
                    $command = \backend\models\Province::findOne(['id' => $data->fk_province]);
                    return $command['name_eng'];
                },
                'label' => 'Province'
            ],
            
                        [
                'attribute' => 'fk_district',
                'value' => function ($data) {
                    $command = \backend\models\Districts::findOne(['id' => $data->fk_district]);
                    return $command['district_eng'];
                },
                'label' => 'District'
            ],
            'mun_nep',
            'mun_eng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
