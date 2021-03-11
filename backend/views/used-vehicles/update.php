<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsedVehicles */

$this->title = 'Update Used Vehicles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Used Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="used-vehicles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
