<?php

namespace backend\controllers;

use backend\controllers\BaseControllers\NewVehiclesController as BaseControllersNewVehiclesController;
use Yii;
use common\models\NewVehicles;
use common\models\NewVehiclesSearch;
use common\models\Vehicles;
use common\models\VehiclesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewVehiclesController implements the CRUD actions for NewVehicles model.
 */
class NewVehiclesController extends BaseControllersNewVehiclesController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NewVehicles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehiclesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'new');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewVehicles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $vehicle = Vehicles::find()->where(['id'=>$id])->with('newVehicles')->all();
        
        return $this->render('view', [
            'model' => $vehicle[0],
        ]);
    }

    /**
     * Creates a new NewVehicles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $vehicles = new Vehicles(['scenario'=>Vehicles::SCENARIO_CREATE]);
        $newVehicle = new NewVehicles();
        if ($newVehicle->load(Yii::$app->request->post())) {
            if($vehicles->load(Yii::$app->request->post())){
                
                $vehicles->imageFile = UploadedFile::getInstance($vehicles,'imageFile');
                $vehicles->main_image = $vehicles->imageFile;
                $newVehicle->v_year = $vehicles->manufacturing_year;
                $vehicles->created_at = time();
                $vehicles->updated_at = time();
                
                $valid1 = $vehicles->validate();
                $valid2 = $newVehicle->validate();
                if($valid1 && $valid2 && $vehicles->save()){
                    $vehicles->imageFile->saveAs(Yii::getAlias('uploads/vehicles_images').'/'.$vehicles->main_image);
                    $newVehicle->v_id = $vehicles->id;
                    if($newVehicle->save()){
                        return $this->redirect(['view', 'id' => $vehicles->id]);
                    }
                }
            }
            
            
        }

        return $this->render('create', [
            'vehicles' => $vehicles,
            'newVehicles' => $newVehicle
        ]);
    }

    /**
     * Updates an existing NewVehicles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $vehicles = Vehicles::findOne($id);
        $vehicles->scenario = "update";
        $new = NewVehicles::find()->where(['v_id'=>$id])->all();
        $newVehicle = NewVehicles::findOne($new[0]->id);
        $curr_image = $vehicles->main_image;
        if ($vehicles->load(Yii::$app->request->post())) {
            if($newVehicle->load(Yii::$app->request->post())){
                
                $vehicles->imageFile = UploadedFile::getInstance($vehicles,'imageFile');
                $vehicles->created_at = time();
                $vehicles->updated_at = time();
                if(!empty($vehicles->imageFile)){
                    $vehicles->main_image = $vehicles->imageFile;
                    $imageName = $vehicles->main_image;

                    $valid1 = $vehicles->validate();
                    $valid2 = $newVehicle->validate();
                    if($valid1 && $valid2 && $vehicles->save()){
                        
                    $newVehicle->v_id = $vehicles->id;
                    
                    $vehicles->imageFile->saveAs(Yii::getAlias('uploads/vehicles_images/').$imageName);
                    if($newVehicle->save()){
                        return $this->redirect(['view', 'id' => $vehicles->id]);
                    }
                }
                    
                }else{
                    $vehicles->main_image = $curr_image;
                    $imageName = $vehicles->main_image;
                    $valid1 = $vehicles->validate();
                    $valid2 = $newVehicle->validate();
                    if($valid1 && $valid2 && $vehicles->save()){
                        
                        $newVehicle->v_id = $vehicles->id;
                        
                        if($newVehicle->save()){
                            return $this->redirect(['view', 'id' => $vehicles->id]);
                        }
                    }
                }
                
                
            }

            
        }

        return $this->render('update', [
            'vehicles' => $vehicles,
            'newVehicle'=>$newVehicle
        ]);
    }

    /**
     * Deletes an existing NewVehicles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Vehicles::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewVehicles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewVehicles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewVehicles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
