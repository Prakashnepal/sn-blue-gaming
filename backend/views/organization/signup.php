<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

$helper = new backend\controllers\Helper();
$data = yii\helpers\ArrayHelper::map(\backend\models\Counter::find()->where(['fk_org' => $helper->getActiveOrganization()])->all(), 'id', 'name');
//var_dump($data);
//die;
$this->title = '';
?>
<div class="">
    <div class="card card-outline card-primary contaioner">

        <div class="card-body">
            <p class="login-box-msg">Register a new User</p>


            <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>
            <?=
            $form->field($model, 'fk_roleModel')->widget(Select2::classname(), [
                'data' => ['1' => 'ADMIN', '2' => 'PIT', '3' => 'CAGE', '4' => 'CCTV', '5' => 'Reception'],
                'options' => ['placeholder' => 'PleaseSelect One...', 'id' => 'account-lev0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?> 
            <?= $form->field($model, 'username')->textInput(['autocomplete' => false]); ?>
            <?= $form->field($model, 'email')->textInput(); ?>
            <?= $form->field($model, 'password')->textInput(['type' => 'password']); ?>

            <?=
            $form->field($model, 'counter')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'PleaseSelect One...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>



            <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>



            <?php \yii\bootstrap4\ActiveForm::end(); ?>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
