<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Counter $model */

$this->title = Yii::t('app', 'Please enter counter details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-create">

    <div class="container bg-info">
         <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
