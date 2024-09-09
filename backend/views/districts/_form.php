<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Districts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container districts-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
            <?= $form->field($model, 'fk_country')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\Country::find()->all(), 'id', 'country_name'),
                'options' => ['placeholder' => 'PleaseSelect One...', 'id' => 'account-lev0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>           
        </div>
        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
            <?= $form->field($model, 'fk_province')->widget(DepDrop::classname(), [
                'options' => ['placeholder' => 'Select ...', 'id' => 'account-lev1'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['account-lev0'],
                    'url' => Url::to(['/districts/province']),
                    'loadingText' => 'Loading child level 1 ...',
                ]
            ]); ?>

        </div>
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'district_nep')->textInput(['maxlength' => true,'placeholder'=>'(Optional)'])?>
        </div>
        <div class="col-sm-12 col-md-6">
             <?= $form->field($model, 'district_eng')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 col-md-12">
             <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
