<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewVehicles */

$this->title = 'Create New Vehicles';
$this->params['breadcrumbs'][] = ['label' => 'New Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-vehicles-create">


    <?= $this->render('_form', [
        'vehicle' => $vehicles,
        'newVehicle'=>$newVehicles
    ]) ?>

</div>
