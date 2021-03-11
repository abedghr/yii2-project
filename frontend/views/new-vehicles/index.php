<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

    <div class="site-index">
    <div class="body-content">
        <?= HTML::a('Publish Used Car','/new-vehicles/create',['class'=>'btn btn-primary']) ?>
        <div class="row mt-3">
        <div class="col-md-12">
        <?php foreach($vehicles as $veh): ?>
            <div class="card panel-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4><?= HTML::encode($veh['user']['username'])?> <span style="font-size:10px;"><?= HTML::encode(date('Y-m-d H:m',$veh['created_at']))?></span></h4>
                        </div>
                        <div class="col-md-3 text-right">
                            <?php if($veh['user']['id'] == Yii::$app->user->id): ?>
                                <?= HTML::a('Edit',['/new-vehicles/update','id'=>$veh['id']],['class'=>'btn btn-warning'])?>
                                <a href="/new-vehicles/delete?id=<?php echo $veh['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5" style="border-right:1px solid gray">
                            <img src="<?php echo Yii::getAlias('http://backend.local/uploads/vehicles_images/').$veh['main_image'] ?>" alt="" width="100%" height="300">
                        </div>
                        <div class="col-md-7">
                        <div class="details">
                            <h3><strong>Details:</strong></h3>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p><strong>Model:</strong> <?=HTML::encode($veh['vModel']['model_name'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> <?=HTML::encode($veh['v_name'])?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Type:</strong> <?=HTML::encode($veh['type'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong> <?=HTML::encode($veh['status'])?></p>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>price:</strong> <?=HTML::encode($veh['price'])?>-JOD</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Vehicles Engine:</strong> <?=HTML::encode($veh['newVehicles']['v_engine'])?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Video Url:</strong> <?=HTML::encode($veh['newVehicles']['video_url'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Vehicles Year:</strong> <?=HTML::encode($veh['newVehicles']['v_year'])?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Manufacturing Year:</strong> <?=HTML::encode($veh['manufacturing_year'])?></p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-info btn-block">View</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        </div>


    </div>
</div>
