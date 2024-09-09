<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Organization */

$this->title = Yii::t('app', 'Enter New Organization Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'org'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
         'user' => $user,
    ]) ?>

</div>
