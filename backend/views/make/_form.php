<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Make */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-default">
    <div class="panel-body" style="background-color: #ffffff;">
        <div class="make-form">
        
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'm_name')->textInput(['maxlength' => true])->label('Make Name') ?>

            <?= $form->field($model, 'imageFile')->fileInput(['class'=>'form-control'])?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
