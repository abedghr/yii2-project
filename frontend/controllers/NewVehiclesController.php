<?php

namespace frontend\controllers;



use common\models\Vehicles;
use common\models\Make;
use common\models\Models;
use common\models\NewVehicles;
use yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class NewVehiclesController extends NewVehiclesController
{
    public function actionIndex(){
        $models = Models::find()->all();
        $vehicles = Vehicles::find()->where(['type'=>'new'])->with(['vModel','user','newVehicles'])->asArray()->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render('index',[
            'models'=>$models,
            'vehicles'=>$vehicles
        ]);
    }

    public function actionCreate()
    {   
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }
        $vehicles = new Vehicles(['scenario'=>Vehicles::SCENARIO_CREATE]);
        /* $vehicles->scenario = 'create'; */
        /* $vehicles->setScenario('create'); */
        $newVehicles = new NewVehicles();
        $my_vehicles = Vehicles::find()
            ->where([
                'user_id'=>Yii::$app->user->identity->id
                ])
                ->with(['vModel','newVehicles'])
                ->orderBy(['created_at' => SORT_DESC])
                ->asArray()->all();

        $makes = Make::find()->select(['id'=>'id','m_name'=>'m_name'])->all();
        $models = Models::find()->select(['id'=>'id','model_name'=>'model_name'])->all();
        
        if($vehicles->load(Yii::$app->request->post())){
            
            if($newVehicles->load(Yii::$app->request->post())){
               
                $vehicles->user_id = Yii::$app->user->identity->id; 
                
                $vehicles->imageFile = UploadedFile::getInstance($vehicles,'imageFile');
               
                
                $vehicles->main_image = time().'_'.$vehicles->imageFile;
                
                $imageName = $vehicles->main_image;
                
                $vehicles->created_at =time();
                $vehicles->updated_at =time();
                    
                $valid = $vehicles->validate();
                $valid2 = $newVehicles->validate();
                if($valid && $valid2 && $vehicles->save()){
                    $vehicles->imageFile->saveAs(Url::to('@backend/web/uploads/vehicles_images/').$imageName);
                    /* if($vehicles->save()){ */
                        $newVehicles->v_id = $vehicles->id;
                        if($newVehicles->save()){
                            Yii::$app->getSession()->setFlash('success_publish','Publish Successfully');
                            return $this->redirect('create');
                        }
                   /*  } */
                }   
            }     
        }
        return $this->render('create',[
            'vehicles'=>$vehicles,
            'newVehicles'=>$newVehicles,
            'myVehicles'=>$my_vehicles,
            'models'=>$models,
            'makes'=>$makes
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

        $n = NewVehicles::find()->where(['v_id'=>$id])->all();
        $newVehicles = NewVehicles::findOne($n[0]->id);
        
        $makes = Make::find()->select(['id'=>'id','m_name'=>'m_name'])->all();
        $models = Models::find()->select(['id'=>'id','model_name'=>'model_name'])->all();
        $current_image = $vehicles->main_image;
        
       
        if ($vehicles->load(Yii::$app->request->post())) {  
            if($newVehicles->load(Yii::$app->request->post())){
                /* if(!$vehicles->validate()){
                    print_r($vehicles->errors);
                    die;
                } */
                /* if(!$newVehicles->validate()){
                    print_r($newVehicles->errors);die;
                }
                if($newVehicles->validate()){
                    echo "veh dsaDie";die;
                }  */     
            $image= UploadedFile::getInstance($vehicles, 'imageFile');
            if(!empty($image)) {
                
                $vehicles->imageFile = $image;
                $vehicles->main_image = time(). $vehicles->imageFile;
                $valid = $vehicles->validate();
                $valid2 = $newVehicles->validate();
                if($valid && $valid2 && $vehicles->save()){
                    $imageName = $vehicles->main_image;
                    $image->saveAs(Url::to('@backend/web/uploads/vehicles_images/').$imageName);
                    $newVehicles->v_id = $vehicles->id;
                    if($newVehicles->save()){
                        Yii::$app->getSession()->setFlash('success_update','Update Successfully');
                        return $this->redirect(['update', 'id' => $vehicles->id]);
                    }
                    
                }
            }else{
                $vehicles->main_image = $current_image;
                $valid = $vehicles->validate();
                $valid2 = $newVehicles->validate();
                if($valid && $valid2 && $vehicles->save()){
                    $newVehicles->v_id = $vehicles->id;
                    if($newVehicles->save()){
                        Yii::$app->getSession()->setFlash('success_update','Update Successfully');
                        return $this->redirect(['update', 'id' => $vehicles->id]);
                    }
                    
                }
            }
            }
                
        }
        
        return $this->render('update',[
            'vehicles'=>$vehicles,
            'newVehicles'=>$newVehicles,
            'models'=>$models,
            'makes'=>$makes
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