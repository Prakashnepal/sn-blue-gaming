<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nationality */

$this->title = Yii::t('app', 'Create Nationality');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nationalities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container nationality-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
