<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transactions */

$this->title = 'Detail view';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transactions-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?php // echo  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo
//        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'fk_member',
                'value' => function ($data) {
                    $member_name = \backend\models\Members::findOne(['id' => $data->fk_member]);
                    return $member_name['name'];
                }
            ],
            // 'created_by',
            'purpose:ntext',
            'remarks:ntext',
            'date',
            'time',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    if ($data['status'] == 1) {

                        return "CHECK-IN";
                    } else {
                        return "CHECK-OUT";
                    }
                }
            ],
        ],
    ])
    ?>

</div>
