<?php
/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="body-content">

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
    <?php if(Yii::$app->getSession()->hasFlash('success_update')): ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->getSession()->getFlash('success_update'); ?>
        </div>
    <?php endif; ?>
    <?php if(Yii::$app->getSession()->hasFlash('del-success')): ?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->getSession()->getFlash('del-success'); ?>
        </div>
    <?php endif; ?>
    <div class="card card-default">
        <div class="card-header">PUBLISH YOUR CAR</div>
        <div class="card-body">
        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($vehicles,'v_name')->textInput(['class'=>'form-control','placeholder'=>'Enter Vehicles Name'])->label('Vehicles Name')?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicles,'manufacturing_year')->textInput(['class'=>'form-control','placeholder'=>'Enter Manufacturing Year'])->label('Manufacturing Year')?>
            </div>
            <div class="col-md-6">
            <?= $form->field($vehicles,'v_make_id')->dropDownList(ArrayHelper::map($makes, 'id', 'm_name'))->label('make')?>
            </div>
            <div class="col-md-6">
            <?= $form->field($vehicles,'v_model_id')->dropDownList(ArrayHelper::map($models, 'id', 'model_name'))->label('Model')?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicles,'price')->textInput(['class'=>'form-control','placeholder'=>'Enter Price'])->label('Vehicles Price')?>
            </div>
            
            <div class="col-md-6">
                <?= $form->field($vehicles,'status')->dropDownList(array(['pending'=>'pending','active'=>'active']),['class'=>'form-control']);?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicles,'type')->dropDownList(array(['new'=>'new','old'=>'old']),['class'=>'form-control']);?>
            </div>
            <div class="col-md-6">
                <?= $form->field($vehicles,'imageFile')->fileInput(['class'=>'form-control'])->label('Vehicle Image')?>
            </div>
            <div class="col-md-6">
                <?= $form->field($newVehicles,'v_engine')->textInput(['class'=>'form-control','placeholder'=>'Enter Engine'])->label('Vehicle Engine')?>
            </div>
            <div class="col-md-6">
                <?= $form->field($newVehicles,'v_year')->textInput(['class'=>'form-control','placeholder'=>'Enter Year'])->label('Vehicle Year')?>
            </div>
            <div class="col-md-12">
                <?= $form->field($newVehicles,'video_url')->textInput(['class'=>'form-control','placeholder'=>'Enter Video Url'])->label('Video Url')?>
            </div>

        </div>
        </div>
        <div class="card-footer">
        <div class="row">
        <div class="col-md-4">
            <?= HTML::submitButton('Publish',['class'=>'btn btn-primary btn-block']);?>
        </div>
        </div>
        
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

</div>
</div>

