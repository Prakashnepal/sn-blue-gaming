<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Points */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="section">
    <div class="card">
        <div class="card-body">

            <div class="transactions-form">

                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'net_points')->widget(Select2::classname(), [
                            'data' => ['POINTS' => 'POINTS', 'CASH' => 'CASH'],
                            'options' => ['placeholder' => 'Select CASH/POINTS'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'points')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'remarks')->textarea(['row' => 1]); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success float-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div><!-- comment -->
    </div>
</div>
