<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CounterType */

$this->title = Yii::t('app', 'Enter Information');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Counter Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid card">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
