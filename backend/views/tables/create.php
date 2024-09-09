<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Tables $model */

$this->title = Yii::t('app', 'Create Tables');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tables-create">

    <h3 class="text-center m-1"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
