<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */

$this->title = 'Update Models: ' . $model->model_name;
$this->params['breadcrumbs'][] = ['label' => 'Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="models-update">


    <?= $this->render('_form', [
        'model' => $model,
        'makes'=>$makes
    ]) ?>

</div>
