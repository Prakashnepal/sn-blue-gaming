<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Province */

$this->title = Yii::t('app', 'Update Province: {name}', [
    'name' => $model->name_eng,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_eng, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container province-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
