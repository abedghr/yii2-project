<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsedVehicles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="used-vehicles-form">
    <div class="panel-default">
        <div class="panel-heading">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'v_id')->textInput() ?>

            <?= $form->field($model, 'v_city')->textInput() ?>

            <?= $form->field($model, 'v_mileage')->textInput() ?>

            <?= $form->field($model, 'v_year')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    

</div>
