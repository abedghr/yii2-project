<?php

use common\models\BaseModels\Vehicles;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VehiclesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="vehicles-index">

<div class="panel-default">
    <div class="panel-heading">
        <p>
            <?= Html::a('Create New Vehicles', ['/new-vehicles/create/'], ['class' => 'btn btn-success']) ?>
            <span style="margin-left:10px;">
                <?= Html::a('Create Used Vehicles', ['/used-vehicles/create'], ['class' => 'btn btn-success']) ?>
            </span>
        
        </p>
    </div>
    <div class="panel-body" style="background-color:#ffffff">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'v_name',
                'v_make_id',
                'v_model_id',
                'price',
                'user_id',
                [

                    'attribute' => 'status',
                    
                    'format' => 'raw',
                    
                    'value' => function ($data) {                      
                    if($data->status == "active")
                    return Html::dropDownList('status',$data->status,array('' => $data->status) + ['pending'],array('class'=>'form-control','onchange'=>'alert("hi")'));
                    else 
                    return Html::dropDownList('status',$data->status,array('' => $data->status) + ['active'],['class'=>'form-control']);
                },


                ],
                'type',
                'manufacturing_year',
                array(
                    'format' => 'html',
                    'attribute'=>'Main Image',
                    'value' => function ($data) {
                        return Html::img(Yii::getAlias('/uploads/vehicles_images/'). $data['main_image'],
                    ['width' => '65px']);}
                ),
                /* 'created_at',
                'updated_at', */

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

    

   


</div>
