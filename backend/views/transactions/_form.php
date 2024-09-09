<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Transactions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section">
    <div class="card">
        <div class="card-body">

            <div class="transactions-form">

                <?php $form = ActiveForm::begin(); ?>
                
                <div class="row">

                   
                    <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">

                        <?= $form->field($model, 'status')->widget(Select2::classname(), [
                            'data' => ['1'=>'IN','0'=>'OUT'],
                            'options' => ['placeholder' => 'PleaseSelect One...'],                
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'purpose')->textarea(['rows' => '1']) ?>
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'remarks')->textarea(['rows' => '1'])  ?>
                    </div>
                </div>


                <!--This after comment Here what to put?-->
                <?php //echo $form->field($model, 'created_by')->textInput() ?>


                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success float-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            
        </div><!-- comment -->
    </div>
</div>
