<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mileage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mileage-form">
    <div class="panel-default">
        <div class="panel-body" style="background-color: #ffffff;">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'v_mileage')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    

</div>
