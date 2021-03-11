<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mileage */

$this->title = 'Create Mileage';
$this->params['breadcrumbs'][] = ['label' => 'Mileages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mileage-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
