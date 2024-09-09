<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipals */

$this->title = Yii::t('app', 'Create Municipals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Municipals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipals-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
