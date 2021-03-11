<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-default">
    <div class="panel-body" style="background-color: #ffffff;">
        <div class="models-form">

            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($model,'make_v_id')->dropDownList(ArrayHelper::map($makes,'id','m_name'))->label('Make')?>

            <?= $form->field($model, 'model_name')->textInput(['maxlength' => true , 'placeholder'=>"Enter Model Name"]) ?>

            <?= $form->field($model, 'model_description')->textarea(['rows' => 6 , 'placeholder'=>'Enter Model Description']) ?>

            <?= $form->field($model,'imageFile')->fileInput(['class'=>'form-control'])?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

