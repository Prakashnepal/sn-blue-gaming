<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MunicipalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="municipals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_country') ?>

    <?= $form->field($model, 'fk_province') ?>

    <?= $form->field($model, 'fk_district') ?>

    <?= $form->field($model, 'mun_nep') ?>

    <?php // echo $form->field($model, 'mun_eng') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
