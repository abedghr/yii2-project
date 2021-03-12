<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewVehiclesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-vehicles-index">
    <div class="panel-default">
        <div class="panel-heading">
            <p>
                <?= Html::a('Create New Vehicles', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="panel-body" style="background-color: #ffffff;">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                        'v_name',
                        [

                            'attribute' => 'v_make_id',
                            
                            'format' => 'raw',
                            
                            'value' => function ($data) {                      
                            return HTML::encode($data->vMAke->m_name);
                        },


                    ],
                    [

                        'attribute' => 'v_model_id',
                        
                        'format' => 'raw',
                        
                        'value' => function ($data) {                      
                        return HTML::encode($data->vModel->model_name);
                    },


                    ],
                        'price',
                        [

                            'attribute' => 'user_id',
                            
                            'format' => 'raw',
                            
                            'value' => function ($data) {                      
                            return $data->user->username;
                        },


                        ],
                        'status'
                        /* [

                            'attribute' => 'status',
                            
                            'format' => 'raw',
                            
                            'value' => function ($data) {                      
                            if($data->status == "active")
                            return Html::dropDownList('status',$data->status,array('' => $data->status) + ['pending'],array('class'=>'form-control','onchange'=>'alert("hi")'));
                            else 
                            return Html::dropDownList('status',$data->status,array('' => $data->status) + ['active'],['class'=>'form-control']);
                        },


                        ] */,
                        'type',
                        'manufacturing_year',
                        [

                            'attribute' => 'main_image',
                            
                            'format' => 'raw',
                            
                            'value' => function ($data) {                      
                                return Html::img(Yii::getAlias('/uploads/vehicles_images/'). $data['main_image'],['alt' => 'pic not found','width'=>75,'height'=>50]);
                        },


                    ],
                        /* 'created_at',
                        'updated_at', */
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); 
            ?>
        </div>
    </div>

</div>
