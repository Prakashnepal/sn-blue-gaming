<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Ccchips $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ccchips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ccchips-view">

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

<!--    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'value',
             'qty',
            'fk_user',
             'remarks',
            [
                'attribute'=>'fk_user',
                'value'=>function($data){
        $user = common\models\User::findOne(['id'=>$data->fk_user]);
        return $user['username'];
                }
            ],
                     [
                'attribute'=>'fk_org',
                'value'=>function($data){
        $user = backend\models\Organization::findOne(['id'=>$data->fk_org]);
        return $user['name'];
                }
            ],
          
           
           
        ],
    ]) ?>

</div>
