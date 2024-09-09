<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Ccchips $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container border shadow">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-sm-12 col-lg-4">  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4 col-sm-12 col-lg-4"> <?= $form->field($model, 'value')->textInput() ?></div>
        <div class="col-md-4 col-sm-12 col-lg-4">  <?= $form->field($model, 'qty')->textInput() ?></div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12">
        <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
    </div>
 
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
