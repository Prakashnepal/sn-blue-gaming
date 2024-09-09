<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CounterType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="counter-type-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
        

        <div class="col-12">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-12">
            <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?> 
        </div>
    </div>
   

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
