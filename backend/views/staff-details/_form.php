<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\StaffDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-details-form">
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-body">


                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'id_card_no')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'emp_id')->textInput(['disabled' => true]) ?>
                    </div>     
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'fk_department')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(backend\models\Department::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'PleaseSelect One...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'fk_designation')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(backend\models\Designation::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'PleaseSelect One...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>     
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
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
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
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
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
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
                        <?= $form->field($model, 'ward_no')->textInput() ?>
                    </div>
                    <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'sign')->widget(DatePicker::classname(), [
                            'id' => 'scheduleProject',
                            'name' => 'scheduleProject',
                            'type' => DatePicker::TYPE_INPUT,
                            'language' => 'en',
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'startDate' => '2000-01-01',
                                'todayHighlight' => true,
                                'todayBtn' => true,
                            ],
//                            'pluginEvents' =>[
//                                "changeDate" => "function(e) {  alert(123)}",
//                            ]    
                        ])->label('ID Expire Date');
                        ?>
                    </div> 
                     <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'dob')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Enter birth date ...', 'autocomplete' => 'off'],
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]);
                        ?>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'blood_group')->widget(Select2::classname(), [
                            'data' => ['O+'=>'O+','O-'=>'O-','A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-'],
                            'options' => ['placeholder' => 'PleaseSelect One...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'guardian_name')->textInput()
                        ?>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'guardian_contact')->textInput()
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'ImageFile')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'CitizenshipDoc')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                        ]);
                        ?>
                    </div>
                    

                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success float-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
