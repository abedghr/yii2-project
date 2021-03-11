<?php

use common\models\Make;
use common\models\Models;
use common\models\User;
use common\models\Vehicles;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewVehicles */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-default">
    <div class="panel-body" style="background-color: #ffffff">
    <div class="new-vehicles-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($vehicle, 'v_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicle, 'v_make_id')->dropDownList(ArrayHelper::map(Make::find()->all(),'id','m_name'),['prompt'=>'Select Make','id'=>'v_make_id']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <?= $form->field($vehicle,'v_model_id')->widget(DepDrop::class,[
                            'options'=>['id'=>'v_model_id'],
                            'pluginOptions'=>[
                                'depends'=>['v_make_id'],
                                'initialize'=>true,
                                'placeholder'=>'Select Model',
                                'url'=>Url::to(['/vehicles/lists']),
                            ]
                        ]);
            ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicle, 'manufacturing_year')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($vehicle, 'imageFile')->fileInput(['class'=>'form-control']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicle, 'price')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($vehicle, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where(['type'=>1])->all(),'id','username')); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicle, 'status')->dropDownList(Vehicles::STATUS) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($newVehicle, 'v_engine')->textInput(['maxlength' => true])->label('Vehicle Engine') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($newVehicle, 'video_url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

