<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Ccchips $model */

$this->title = Yii::t('app', 'Add A New Chips');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ccchips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccchips-create">

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
