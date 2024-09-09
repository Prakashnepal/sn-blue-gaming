<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Points */

$this->title = Yii::t('app', 'Entry Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'COUNTER'), 'url' => ['ac/counter','id'=>$cno]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container points-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
