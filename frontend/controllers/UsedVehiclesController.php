<?php

namespace frontend\controllers;

use common\models\City;
use common\models\Vehicles;
use common\models\Make;
use common\models\Mileage;
use common\models\Models;
use common\models\NewVehicles;
use common\models\UsedVehicles;
use frontend\controllers\BaseControllers\UsedVehiclesController as BaseControllersUsedVehiclesController;
use yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UsedVehiclesController extends BaseControllersUsedVehiclesController
{
    
    public function actionIndex(){
        $models = Models::find()->all();

        $vehicles = Vehicles::find()
                        ->where(['type'=>'old'])
                        ->with(['vModel','user','usedVehicles', 'usedVehicles.vCity','usedVehicles.vMileage'])
                        ->asArray()
                        ->orderBy(['created_at' => SORT_DESC])
                        ->all();

        /* $usedData = UsedVehicles::find()
                            ->where(['v_id'=>$vehicles[0]['id']])
                            ->with('vCity','vMileage')
                            ->asArray()
                            ->all();
        $usedVData = [
            'city'=> $usedData[0]['vCity']['city_name'],
            'mileage'=>$usedData[0]['vMileage']['v_mileage']
        ]; */
        
        return $this->render('index',[
            'models'=>$models,
            'vehicles'=>$vehicles,
            /* 'usedVData'=>$usedVData */
        ]);
    }

    public function actionCreate()
    {   
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }
        $vehicles = new Vehicles();
        $usedVehicles = new UsedVehicles();
        $my_vehicles = Vehicles::find()
            ->where([
                'user_id'=>Yii::$app->user->identity->id
                ,'type'=>'old'])
                ->with(['vModel','usedVehicles','usedVehicles.vCity','usedVehicles.vMileage'])
                ->orderBy(['created_at' => SORT_DESC])
                ->asArray()->all();

        $makes = Make::find()->select(['id'=>'id','m_name'=>'m_name'])->all();
        $models = Models::find()->select(['id'=>'id','model_name'=>'model_name'])->all();
        $cities = City::find()->all();
        $mileages = Mileage::find()->all();

        
        if($vehicles->load(Yii::$app->request->post())){
            
            if($usedVehicles->load(Yii::$app->request->post())){
               
                $vehicles->user_id = Yii::$app->user->identity->id; 
                
                $vehicles->imageFile = UploadedFile::getInstance($vehicles,'imageFile');
               
                
                $vehicles->main_image = time().'_'.$vehicles->imageFile;
                
                $imageName = $vehicles->main_image;
                
                $vehicles->created_at =time();
                $vehicles->updated_at =time();
                
                $valid = $vehicles->validate();
                $valid2 = $usedVehicles->validate();
                if($valid && $valid2 && $vehicles->save()){
                    $vehicles->imageFile->saveAs(Url::to('@backend/web/uploads/vehicles_images/').$imageName);
                        $usedVehicles->v_id = $vehicles->id;
                        if($usedVehicles->save()){
                            Yii::$app->getSession()->setFlash('success_publish','Publish Successfully');
                            return $this->redirect('create');
                        }
                }   
            }     
        }
        
        return $this->render('create',[
            'vehicles'=>$vehicles,
            'usedVehicles'=>$usedVehicles,
            'myVehicles'=>$my_vehicles,
            'models'=>$models,
            'makes'=>$makes,
            'cities'=>$cities,
            'mileages'=>$mileages
        ]);
    }
    /* public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    } */
    public function actionUpdate($id){
        
        $vehicles = Vehicles::findOne($id);
        
        if($vehicles->user_id != Yii::$app->user->id){
            return $this->redirect(['site/login']);
        }
        $cities = City::find()->all();
        $mileages = Mileage::find()->all();
        

        $used = UsedVehicles::find()->where(['v_id'=>$id])->all();
        
        $usedVehicles = UsedVehicles::findOne($used[0]->id);
        
        $makes = Make::find()->select(['id'=>'id','m_name'=>'m_name'])->all();
        $models = Models::find()->select(['id'=>'id','model_name'=>'model_name'])->all();
        $current_image = $vehicles->main_image;
        
       
        if ($vehicles->load(Yii::$app->request->post())) {  
            if($usedVehicles->load(Yii::$app->request->post())){
                    
            $image= UploadedFile::getInstance($vehicles, 'imageFile');
            if(!empty($image)) {
                
                $vehicles->imageFile = $image;
                $vehicles->main_image = time().'_'. $vehicles->imageFile;
                $valid = $vehicles->validate();
                $valid2 = $usedVehicles->validate();
                if($valid && $valid2 && $vehicles->save()){
                    $imageName = $vehicles->main_image;
                    $image->saveAs(Url::to('@backend/web/uploads/vehicles_images/').$imageName);
                    $usedVehicles->v_id = $vehicles->id;
                    if($usedVehicles->save()){
                        Yii::$app->getSession()->setFlash('success_update','Update Successfully');
                        return $this->redirect(['update', 'id' => $vehicles->id]);
                    }
                    
                }
            }else{
                $vehicles->main_image = $current_image;
                $valid = $vehicles->validate();
                $valid2 = $usedVehicles->validate();
                if($valid && $valid2 && $vehicles->save()){
                    $usedVehicles->v_id = $vehicles->id;
                    if($usedVehicles->save()){
                        Yii::$app->getSession()->setFlash('success_update','Update Successfully');
                        return $this->redirect(['update', 'id' => $vehicles->id]);
                    }
                    
                }
            }
            }
                
        }
        
        return $this->render('update',[
            'vehicles'=>$vehicles,
            'usedVehicles'=>$usedVehicles,
            'models'=>$models,
            'makes'=>$makes,
            'cities'=>$cities,
            'mileages'=>$mileages
        ]);
    }

    public function actionDelete($id){
        $vehicles = Vehicles::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('del-success','Delete Successfully');
        return $this->redirect(['create']);
    }

    
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