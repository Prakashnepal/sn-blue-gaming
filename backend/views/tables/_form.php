<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\Tables $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="tables-form">
    <div class="container border">
        <div class="row">
            <div class="col-md-4 co-sm-12 col-lg-4">    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4 co-sm-12 col-lg-4"><?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-4 co-sm-12 col-lg-4">    <?= $form->field($model, 'value')->textInput() ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4 co-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12"> <?=
                        $form->field($model, 'fk_counter')->widget(kartik\select2\Select2::classname(), [
                            'data' => ArrayHelper::map(backend\models\Counter::find()->where(['fk_org' => \backend\controllers\Helper::getActiveOrganization()])->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'PleaseSelect One...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('Type');
                        ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-8 co-sm-12 col-lg-8">    <?= $form->field($model, 'remarks')->textarea(['rows' => 2]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
