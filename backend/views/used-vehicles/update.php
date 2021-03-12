<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsedVehicles */

$this->title = 'Update Used Vehicles: ' . $vehicle->id;
$this->params['breadcrumbs'][] = ['label' => 'Used Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vehicle->id, 'url' => ['view', 'id' => $vehicle->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="used-vehicles-update">
    <?= $this->render('_form', [
        'vehicle' => $vehicle,
        'usedVehicle'=>$usedVehicle
    ]) ?>

</div>
