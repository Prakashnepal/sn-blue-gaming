<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transactions */

$this->title = Yii::t('app', 'Enter In/Out Information');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'inOut'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
