<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StaffDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'fk_department') ?>

    <?= $form->field($model, 'fk_designation') ?>

    <?= $form->field($model, 'fk_org') ?>

    <?php // echo $form->field($model, 'fk_country') ?>

    <?php // echo $form->field($model, 'fk_province') ?>

    <?php // echo $form->field($model, 'fk_district') ?>

    <?php // echo $form->field($model, 'fk_municipal') ?>

    <?php // echo $form->field($model, 'status') ?>
    
    <?php // echo $form->field($model, 'blood_group') ?>
    
    <?php // echo $form->field($model, 'guardian_name') ?>
    
    <?php // echo $form->field($model, 'guardian_contact') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'contact_no') ?>

    <?php // echo $form->field($model, 'ward_no') ?>

    <?php // echo $form->field($model, 'sign') ?>

    <?php // echo $form->field($model, 'emp_id') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'citizenship_doc') ?>

    <?php // echo $form->field($model, 'id_card_no') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
