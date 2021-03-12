<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */

$this->title = $model->model_name;
$this->params['breadcrumbs'][] = ['label' => 'Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="models-view">
    <div class="panel-default">
        <div class="panel-heading">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="panel-body" style="background-color: #ffffff;">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <td><?= $model->id ?></td>
                </tr>
                <tr>
                    <th>Make</th>
                    <td><?= $model->make_v_id ?></td>
                </tr>
                <tr>
                    <th>Model Name</th>
                    <td><?= $model->model_name ?></td>
                </tr>
                <tr>
                    <th>Model Description</th>
                    <td><?= $model->model_description ?></td>
                </tr>
                <tr>
                    <th>Model Image</th>
                    <td><img src="<?= Yii::getAlias('/uploads/models_images').'/'.$model->model_logo?>" height="80" alt=""></td>
                </tr>
            </table>
        </div>
    </div>
    
    
    

    

</div>
