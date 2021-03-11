<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewVehicles */

$this->title = 'Update New Vehicles: ' . $vehicles->v_name;
$this->params['breadcrumbs'][] = ['label' => 'New Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vehicles->id, 'url' => ['view', 'id' => $vehicles->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-vehicles-update">


    <?= $this->render('_form', [
        'vehicle' => $vehicles,
        'newVehicle'=>$newVehicle
    ]) ?>

</div>
