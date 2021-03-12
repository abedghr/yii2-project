<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Make */

$this->title = 'Update Make: ' . $model->m_name;
$this->params['breadcrumbs'][] = ['label' => 'Makes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="make-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
