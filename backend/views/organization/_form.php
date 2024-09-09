<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="m-2">
    <!--    <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
    
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
    
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
    
            </div>     
        </div>-->
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'landline')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'pan_vat')->textInput(['maxlength' => true]) ?>
        </div>


    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'contact_person_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'contact_person_email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'contact_person_mobile')->textInput(['maxlength' => true]) ?>
        </div>     
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
            <?= $form->field($model, 'pin')->textInput(['maxlength' => true,'placeholder'=>'PRINT PIN']) ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_country')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\Country::find()->all(), 'id', 'country_name'),
                'options' => ['placeholder' => 'PleaseSelect One...', 'id' => 'account-lev0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?> 
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_province')->widget(DepDrop::classname(), [
                'options' => ['placeholder' => 'Select ...', 'id' => 'account-lev1'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['account-lev0'],
                    'url' => Url::to(['/districts/province']),
                    'loadingText' => 'Loading child level 1 ...',
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_district')->widget(DepDrop::classname(), [
                // 'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...', 'id' => 'account-lev2'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['account-lev1'],
                    'url' => Url::to(['/municipals/district']),
                    'loadingText' => 'Loading districts ...',
                ]
            ]);
            ?>
        </div>     
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_municipal')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['account-lev2'],
                    'initialize' => true,
                    'initDepends' => ['account-lev0'],
                    'url' => Url::to(['/members/municipals']),
                    'loadingText' => 'Loading Municipals ...'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'fk_city')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(backend\models\Cities::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'PleaseSelect One...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
            <?= $form->field($model, 'ward')->textInput() ?>
        </div>  
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?= $form->field($model, 'weblink')->textInput(['maxlength' => true]) ?>
        </div>  
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'LogoFile')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'CertificateFile')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'staffID')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ])->label('Staff-ID Layout');
            ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'SilverFront')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>     
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'SilverBack')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'GoldenFront')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'GoldenBack')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>     
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'BlackFront')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>   
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'BlackBack')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'WhiteFront')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>   
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'WhiteBack')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
