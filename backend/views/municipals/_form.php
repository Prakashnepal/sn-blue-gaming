<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container municipals-form">


    
    <?php $form = ActiveForm::begin(); ?>
    
    <div  class="row">
        <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'fk_country')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\Country::find()->all(), 'id', 'country_name'),
                'options' => ['placeholder' => 'PleaseSelect One...', 'id' => 'account-lev0'],                
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>        
        </div>
        <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'fk_province')->widget(DepDrop::classname(), [
                'options' => ['placeholder' => 'Select ...', 'id' => 'account-lev1'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['account-lev0'],
                    'url' => Url::to(['/municipals/province']),
                    'loadingText' => 'Loading provinces/states...',
                ]
            ]); ?>

        </div>
        <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'fk_district')->widget(DepDrop::classname(), [
                // 'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...', 'id' => 'account-lev2'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['account-lev1'],
                    'url' => Url::to(['/municipals/district']),
                    'loadingText' => 'Loading districts ...',
                ]
            ]); ?>
        </div>
        <div class="col-sm-12 col-md-6">
             <?= $form->field($model, 'mun_nep')->textInput(['maxlength' => true])?>
        </div>
        <div class="col-sm-12 col-md-6">
             <?= $form->field($model, 'mun_eng')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 col-md-12">
              <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
