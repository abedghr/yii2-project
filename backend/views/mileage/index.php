<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MileageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mileages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mileage-index">
    <div class="panel-default">
        <div class="panel-heading">
            <p>
                <?= Html::a('Create Mileage', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'v_mileage',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
    

    


</div>
