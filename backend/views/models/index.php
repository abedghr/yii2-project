<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ModelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-index">
    <div class="panel-default">
        <div class="panel-heading">
            <p>
                <?= Html::a('Create Models', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'model_name',
                    'model_description:ntext',
                    array(
                        'format' => 'html',
                        'attribute'=>'model_logo',
                        'value' => function ($data) {
                            return Html::img(Yii::getAlias('/uploads/models_images/'). $data['model_logo'],
                        ['width' => '65px']);}
                    ),
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

    
 

</div>
