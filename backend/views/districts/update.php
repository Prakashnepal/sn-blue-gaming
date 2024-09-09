<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Districts */

$this->title = Yii::t('app', 'Update Districts: {name}', [
    'name' => $model->district_eng,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->district_eng, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container districts-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
