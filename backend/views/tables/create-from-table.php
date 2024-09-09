<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\TableChips $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="table-chips-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container border">
        <div class="row">
            <div class="col-md-4 co-sm-12 col-lg-4"> <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-4 co-sm-12 col-lg-4">    <?= $form->field($model, 'value')->textInput() ?>
            </div>
            <div class="col-md-4 co-sm-12 col-lg-4">    <?= $form->field($model, 'qty')->textInput() ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4 co-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-md-12 co-sm-12 col-lg-12">    <?= $form->field($model, 'fk_table')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(backend\models\Tables::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'PleaseSelect One...',
                                'value'=>$tableid
                            ],
                        'disabled'=>true,
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-12 co-sm-12 col-lg-12">    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
                    </div> 
                </div>
            </div>
            <div class="col-md-8 co-sm-12 col-lg-8">    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
            </div>


        </div>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
