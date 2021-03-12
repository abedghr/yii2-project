<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsedVehicles */

$this->title = $model->v_name;
$this->params['breadcrumbs'][] = ['label' => 'Used Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="used-vehicles-view">
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
            <table class="table table-striped">
                <tr>
                    <th colspan="2">
                        <img src="<?php echo Yii::getAlias('/uploads/vehicles_images/').$model->main_image ?>" alt="" width="300" height="250">
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <td><?= HTML::encode($model->id)?></td>
                </tr>
                <tr>
                    <th>Vehicle Name</th>
                    <td><?= HTML::encode($model->v_name)?></td>
                </tr>
                <tr>
                    <th>Make</th>
                    <td><?= HTML::encode($model->vMAke->m_name)?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?= HTML::encode($model->vModel->model_name)?></td>
                </tr>
                <tr>
                    <th>Manufacturing Year</th>
                    <td><?= HTML::encode($model->manufacturing_year)?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?= HTML::encode($model->price)?> JOD</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?= HTML::encode($model->type)?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= HTML::encode($model->status)?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?= HTML::encode($model->usedVehicles->vCity->city_name)?></td>
                </tr>
                <tr>
                    <th>Vehicle Mileage</th>
                    <td><?= HTML::encode($model->usedVehicles->vMileage->v_mileage)?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?= HTML::encode(date('Y-m-d H:s',$model->created_at))?></td>
                </tr>
            </table>
        </div>
    </div>

</div>
