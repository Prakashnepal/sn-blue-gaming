<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Province */
/* @var $form yii\widgets\ActiveForm */
//print_r($data);die;
?>


<!--<h3><?= Html::encode($this->title) ?></h3>-->
<div class=" container province-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_country')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\Country::find()->all(), 'id', 'country_name'),
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>            
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'name_nep')->textInput(['maxlength' => true,'placeholder'=>'लुम्बिनी प्रदेश']) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'name_eng')->textInput(['maxlength' => true,'placeholder'=>'Lumbini Province']) ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>



