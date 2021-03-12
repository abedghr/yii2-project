<?php
/* @var $this yii\web\View */

use common\models\Make;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
?>
<div class="body-content">

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
    <?php if(Yii::$app->getSession()->hasFlash('success_publish')): ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->getSession()->getFlash('success_publish'); ?>
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
            </div>
            <div class="row">
            <div class="col-md-6">
                        <?= $form->field($vehicles,'v_make_id')->dropDownList(ArrayHelper::map(Make::find()->all(),'id','m_name'),['prompt'=>'Select Make','id'=>'v_make_id']) ?>
                </div>
                <div class="col-md-6">
                        <?= $form->field($vehicles,'v_model_id')->widget(DepDrop::class,[
                            'options'=>['id'=>'v_model_id'],
                            'pluginOptions'=>[
                                'depends'=>['v_make_id'],
                                'initialize'=>true,
                                'placeholder'=>'Select Model',
                                'url'=>Url::to(['/vehicles/lists'])
                            ]
                        ]);
                        ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($vehicles,'price')->textInput(['class'=>'form-control','placeholder'=>'Enter Price'])->label('Vehicles Price')?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($vehicles,'status')->dropDownList(array('pending','active'),['class'=>'form-control']);?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($vehicles,'type')->dropDownList(array('new','old'),['class'=>'form-control']);?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($vehicles,'imageFile')->fileInput(['class'=>'form-control'])->label('Vehicle Image')?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($newVehicles,'v_engine')->textInput(['class'=>'form-control','placeholder'=>'Enter Engine'])->label('Vehicle Engine')?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($newVehicles,'v_year')->textInput(['class'=>'form-control','placeholder'=>'Enter Year'])->label('Vehicle Year')?>
                </div>
            </div> 
            <div class="row">
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

<?php foreach($myVehicles as $veh): ?>
    <div class="row mt-5">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card card-default">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <?=HTML::encode(Yii::$app->user->identity->username)?>
                    </div>
                    <div class="col-md-3 text-right">
                        <?= HTML::a('Edit',['update','id'=>$veh['id']],['class'=>'btn btn-warning'])?>
                        <a href="/new-vehicles/delete?id=<?php echo $veh['id']?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-5" style="border-right:1px solid gray">
                    <img src="<?php echo Yii::getAlias(Url::to('http://backend.local/uploads/vehicles_images/').$veh['main_image']) ?>" width="100%" height="200" alt="">
                </div>
                <div class="col-md-7">
                    <div class="details">
                        <h3><strong>Details:</strong></h3>
                        <p><strong>Model:</strong> <?=HTML::encode($veh['vModel']['model_name'])?></p>
                        <p><strong>Name:</strong> <?=HTML::encode($veh['v_name'])?></p>
                        <p><strong>Type:</strong> <?=HTML::encode($veh['type'])?></p>
                        <p><strong>Status:</strong> <?=HTML::encode($veh['status'])?></p>
                        <p><strong>price:</strong> <?=HTML::encode($veh['price'])?>-JOD</p>
                        <p><strong>Manufacturing Year:</strong> <?=HTML::encode($veh['manufacturing_year'])?></p>
                    </div>
                </div>
                </div>
               
                
            </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
<?php endforeach; ?>

</div>