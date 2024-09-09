<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FiscalYear */

$this->title = Yii::t('app', 'Create Fiscal Year');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fiscal Years'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fiscal-year-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
