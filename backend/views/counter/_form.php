<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use backend\models\CounterType;

/** @var yii\web\View $this */
/** @var backend\models\Counter $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="counter-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container border">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-lg-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div> 
            <div class="col-md-4 col-sm-12 col-lg-4">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            </div> 

            <div class="col-md-4 col-sm-12 col-lg-4">
                <?=
                $form->field($model, 'fk_type')->widget(Select2::className(),
                        [
                            'data' => yii\helpers\ArrayHelper::map(CounterType::find()->where(['fk_org' => \backend\controllers\Helper::getActiveOrganization()])->all(), 'id', 'type'),
                            'options' => [
                                'placeholder' => 'Eg: CASH/CHIPS',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                ?>

            </div>
        </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                <?= $form->field($model, 'manager')->textInput(['maxlength' => true]) ?>
            </div> 
                        <div class="col-md-6 col-sm-12 col-lg-6">
                <?= $form->field($model, 'manager_sign')->textInput(['maxlength' => true]) ?>
            </div> 
                </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-lg-12">
                <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>  
            </div> 
        </div>



        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
