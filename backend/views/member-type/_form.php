<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-type-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
