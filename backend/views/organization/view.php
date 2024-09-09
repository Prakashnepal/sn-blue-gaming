<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organization-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'email:email',
            'name',
            'weblink',
            'landline',
            'contact_person_name',
            'contact_person_email:email',
            'contact_person_mobile',
            'logo',
            'pan_vat',
            'certificate',
            'silver_front',
            'silver_back',
            'gold_front',
            'gold_back',
            'fk_country',
            'fk_province',
            'fk_district',
            'fk_municipal',
            'fk_city',
            'fk_user',
            'ward',
            'created_date',
            'updated_date',
            'last_updated_by',
            'status',
            'pin',
            'black_front',
            'black_back',
        ],
    ]) ?>

</div>
