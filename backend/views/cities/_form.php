<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container cities-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
