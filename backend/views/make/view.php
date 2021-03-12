<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Make */

$this->title = $model->m_name;
$this->params['breadcrumbs'][] = ['label' => 'Makes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="panel-default">
    <div class="panel-heading">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
    </div>
    <div class="panel-body" style="background-color: #ffffff;">
    <div class="make-view">
    <p>
        
    </p>

    <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <td><?= $model->id ?></td>
            </tr>
            <tr>
                <th>Make Name</th>
                <td><?= $model->m_name ?></td>
            </tr>
                <th>Make Logo</th>
                <td><img src="<?= Yii::getAlias('/uploads/makes_images').'/'.$model->make_logo?>" height="80" alt=""></td>
            </tr>
    </table>

</div>
    </div>
</div>

