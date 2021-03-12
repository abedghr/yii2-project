<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Vehicles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'v_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'v_model_id')->textInput() ?>

    <?= $form->field($model, 'manufacturing_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'main_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
