<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsedVehicles */

$this->title = 'Create Used Vehicles';
$this->params['breadcrumbs'][] = ['label' => 'Used Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="used-vehicles-create">


    <?= $this->render('_form', [
        'vehicle' => $vehicle,
        'usedVehicle'=>$usedVehicle
    ]) ?>

</div>
