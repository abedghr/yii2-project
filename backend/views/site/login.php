<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-default" style="box-shadow: 5px 5px 10px silver; border:1px solid silver; padding:5px;">
    <div class="panel-heading" style="background-color: steelblue;">
        <h3 style="padding: 8px 0px 8px 8px; color:white;">Admin Login</h3>
    </div>
        <div class="panel-body" style="padding: 5px;">
    <div class="site-login">
        <div class="login-box">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', ['template' => '
                        <div class="" style="margin-top:15px;">
                            <div class="">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                {input}
                            </div>{error}{hint}
                        </div>'])->textInput(['autofocus' => true])
                                ->input('text', ['placeholder'=>'Username']) ?>

                <?= $form->field($model, 'password', ['template' => '
                        <div class="" style="margin-top:15px;">
                            <div class="">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                {input}
                            </div>{error}{hint}
                        </div>'])->passwordInput()
                                ->input('password', ['placeholder'=>'Password'])?>


                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
    </div>
</div>
    </div>
</div>

