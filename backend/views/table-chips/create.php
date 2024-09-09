<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TableChips $model */

$this->title = Yii::t('app', 'Add a new table chips');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Table Chips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-chips-create">
<div class="container-fluid ">

    <h3 class="text-center bg-primary"><?= Html::encode($this->title) ?></h3>
</div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
