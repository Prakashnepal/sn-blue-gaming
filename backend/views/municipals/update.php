<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipals */

$this->title = Yii::t('app', 'Update Municipals: {name}', [
    'name' => $model->mun_eng,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Municipals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mun_eng, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="municipals-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
