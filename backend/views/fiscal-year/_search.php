<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FiscalYearSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fiscal-year-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'year_name') ?>

    <?= $form->field($model, 'start_from') ?>

    <?= $form->field($model, 'bill_counter') ?>

    <?= $form->field($model, 'end_at') ?>

    <?php // echo $form->field($model, 'is_closed') ?>

    <?php // echo $form->field($model, 'fk_org') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
