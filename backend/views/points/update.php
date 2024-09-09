<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Points */

$this->title = Yii::t('app', 'Update Points: {name}', [
    'name' => $model->points,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->points, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container points-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
