<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsedVehiclesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Used Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="used-vehicles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Used Vehicles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'v_id',
            'v_city',
            'v_mileage',
            'v_year',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
