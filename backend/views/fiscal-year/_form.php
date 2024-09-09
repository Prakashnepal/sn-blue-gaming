<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FiscalYear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fiscal-year-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'year_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'start_from')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'end_at')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'bill_counter')->textInput() ?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'is_closed')->textInput() ?>
        </div>
    </div>
    
    <?= $form->field($model, 'fk_org')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
