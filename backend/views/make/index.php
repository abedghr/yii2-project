<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MakeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Makes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="make-index">
    
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <div class="panel-default">
        <div class="panel-heading">
            <p>
                <?= Html::a('Create Make', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="panel-body"style="background-color:#ffffff;">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
                    'id',
                    'm_name',
                    array(
                        'format' => 'html',
                        'attribute'=>'model_logo',
                        'value' => function ($data) {
                            return Html::img(Yii::getAlias('/uploads/makes_images/'). $data['make_logo'],
                        ['width' => '65px']);}
                    ),
                    ['class' => 'yii\grid\ActionColumn']
                ],
            ]); ?>
        </div>
    </div>
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    


</div>
