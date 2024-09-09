<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrganizationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'weblink') ?>

    <?php // echo $form->field($model, 'landline') ?>

    <?php // echo $form->field($model, 'contact_person_name') ?>

    <?php // echo $form->field($model, 'contact_person_email') ?>

    <?php // echo $form->field($model, 'contact_person_mobile') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'pan_vat') ?>

    <?php // echo $form->field($model, 'certificate') ?>

    <?php // echo $form->field($model, 'silver_front') ?>

    <?php // echo $form->field($model, 'silver_back') ?>

    <?php // echo $form->field($model, 'gold_front') ?>

    <?php // echo $form->field($model, 'gold_back') ?>

    <?php // echo $form->field($model, 'fk_country') ?>

    <?php // echo $form->field($model, 'fk_province') ?>

    <?php // echo $form->field($model, 'fk_district') ?>

    <?php // echo $form->field($model, 'fk_municipal') ?>

    <?php // echo $form->field($model, 'fk_city') ?>

    <?php // echo $form->field($model, 'fk_user') ?>

    <?php // echo $form->field($model, 'ward') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'last_updated_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'pin') ?>

    <?php // echo $form->field($model, 'black_front') ?>

    <?php // echo $form->field($model, 'black_back') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
