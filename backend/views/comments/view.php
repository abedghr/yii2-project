<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Comments */

$this->title = 'Comment ID: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comments-view">
    <div class="panel-default">
        <div class="panel-heading">
            <p>
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
        <table class="table table-striped">
                <tr>
                    <th colspan="2">
                        
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <td><?= HTML::encode($model->id)?></td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td><?= HTML::encode($model->user->username)?></td>
                </tr>
                <tr>
                    <th>Vehicle</th>
                    <td><?= HTML::encode($model->vehicle->v_name)?></td>
                </tr>
                <tr>
                    <th>Comment</th>
                    <td><textarea name="" id="" class="form-control" readonly><?= HTML::encode($model->comment)?></textarea></td>
                </tr>
            </table>

        </div>
    </div>
    

    
</div>
