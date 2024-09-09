<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Organization */

//$this->title = Yii::t('app', 'Enter: {name} details', [
//    'name' => $model->name,
//]);
//$this->params['title'][]='jhdjkfghdkjg';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="organization-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_', [
        'model' => $model,
    ]) ?>

</div>
