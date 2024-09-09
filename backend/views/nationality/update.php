<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nationality */

$this->title = Yii::t('app', 'Update Nationality: {name}', [
    'name' => $model->nationality,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nationalities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nationality, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container nationality-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
