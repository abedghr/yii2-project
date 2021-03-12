<?php

namespace frontend\controllers;



use common\models\Vehicles;
use common\models\Make;
use common\models\Models;
use common\models\NewVehicles;
use frontend\controllers\BaseControllers\VehiclesController as BaseControllersVehiclesController;
use yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class VehiclesController extends BaseControllersVehiclesController
{
    
    
    public function actionLists(){
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        $out = [];
        $post = Yii::$app->request->post();
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $make_id = $parents[0];
                $models = Models::find()->where(['make_v_id'=>$make_id])->all();
                if(!$models){
                    return ['output'=>$out, 'selected'=>''];
                }
                $st = [];
                foreach($models as $model){
                    $st[] = ['id'=>$model['id'],'name'=>$model['model_name']];
                }
                
                return ['output'=>$st, 'selected'=>$make_id];
            }
        }
    }
    
}