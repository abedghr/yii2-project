<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\Html;
use yii\web\JsExpression;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script type="module">
  import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'
    
  const swiper = new Swiper()
</script>

<style>

</style>


<div class="container">
    <div class="site-index"> 
        <div class="row">
        <div class="col-md-8">

            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">

			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
					<img class="d-block w-100" src="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" alt="First slide" width="400" height="300">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://fakeimg.pl/1920x930/" alt="Second slide" width="400" height="300">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://fakeimg.pl/1920x930/" alt="Third slide" width="400" height="300">
				</div>
			</div>

			
			
		</div> 
        </div>
        <div class="col-md-4">

			<a class="carousel-control-prev" style="position:absolute;" href="#carousel-thumb" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only" style="transform: rotate(90deg);">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only" style="transform: rotate(90deg);">Next</span>
			</a>

            <ol class="test" style="overflow-y:scroll; height:300px; list-style:none; margin-left: -54px; margin-right: -15px;">
				<li data-target="#carousel-thumb" data-slide-to="0" class="active pb-1">
					<img class="d-block w-100" src="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" class="img-fluid" width="200" height="150">
				</li>
				<li data-target="#carousel-thumb" data-slide-to="1" class="pb-1">
					<img class="d-block w-100" src="https://fakeimg.pl/1920x930/" class="img-fluid" width="100%" height="150">
				</li>
				<li data-target="#carousel-thumb" data-slide-to="2" class="">
					<img class="d-block w-100" src="https://fakeimg.pl/1920x930/" class="img-fluid" width="100%" height="150">
				</li>
			</ol>
        </div>
        
         <!--    <div class="col-md-8">
            <div id="demo" class="carousel slide" data-ride="carousel"> -->
                <!-- The slideshow -->
              <!--   <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" alt="Los Angeles" width="100%" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" alt="Chicago" width="100%" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" alt="Chicago" width="100%" height="500">
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-4 bg-danger"> -->
            <!-- Indicators -->
           <!--  <ul class="carousel-indicators">
            <li data-target="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" data-slide-to="0"><img src="https://cdn.eso.org/images/thumb300y/eso1907a.jpg" alt="Chicago" width="100%" height="500"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li> -->
            <!-- Left and right controls -->
<!-- <a class="carousel-control-prev" href="#demo" data-slide="prev"> -->
 <!--  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>
            </ul>
            </div>
        </div> -->
    <div class="body-content">
        <?= HTML::a('Publish Used Car','/used-vehicles/create',['class'=>'btn btn-primary']) ?>
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
                                <?= HTML::a('Edit',['/used-vehicles/update','id'=>$veh['id']],['class'=>'btn btn-warning'])?>
                                <a href="/used-vehicles/delete?id=<?php echo $veh['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Model:</strong> <?=HTML::encode($veh['vModel']['model_name'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> <?=HTML::encode($veh['v_name'])?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Status:</strong> <?=HTML::encode($veh['status'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>price:</strong> <?=HTML::encode($veh['price'])?>-JOD</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Manufacturing Year:</strong> <?=HTML::encode($veh['manufacturing_year'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>City:</strong> <?=HTML::encode($veh['usedVehicles']['vCity']['city_name'])?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Mileage:</strong> <?=HTML::encode($veh['usedVehicles']['vMileage']['v_mileage'])?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Vehicles Year:</strong> <?=HTML::encode($veh['usedVehicles']['v_year'])?></p>
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

