<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Make */

$this->title = 'Create Make';
$this->params['breadcrumbs'][] = ['label' => 'Makes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="make-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
