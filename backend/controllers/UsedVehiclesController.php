<?php

namespace backend\controllers;

use backend\controllers\BaseControllers\UsedVehiclesController as BaseControllersUsedVehiclesController;
use common\models\NewVehicles;
use Yii;
use common\models\UsedVehicles;
use common\models\UsedVehiclesSearch;
use common\models\Vehicles;
use common\models\VehiclesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsedVehiclesController implements the CRUD actions for UsedVehicles model.
 */
class UsedVehiclesController extends BaseControllersUsedVehiclesController
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
     * Lists all UsedVehicles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehiclesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'old');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsedVehicles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $vehicle = Vehicles::find()->where(['id'=>$id])->with('usedVehicles','usedVehicles.vCity','usedVehicles.vMileage')->all();
        return $this->render('view', [
            'model' => $vehicle[0],
        ]);
    }

    /**
     * Creates a new UsedVehicles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $vehicle = new Vehicles(['scenario'=>Vehicles::SCENARIO_CREATE]);
        $usedVehicle = new UsedVehicles();

        if ($vehicle->load(Yii::$app->request->post())) {
            if($usedVehicle->load(Yii::$app->request->post())){
                $vehicle->imageFile = UploadedFile::getInstance($vehicle,'imageFile');
                $vehicle->main_image = time().$vehicle->imageFile;
                $vehicle->created_at = time();
                $vehicle->updated_at = time();
                $usedVehicle->v_year = $vehicle->manufacturing_year;
                $valid1 = $vehicle->validate();
                $valid2 = $usedVehicle->validate();
                if($valid1 && $valid2 && $vehicle->save()){
                    $vehicle->imageFile->saveAs(Yii::getAlias('uploads/vehicles_images').'/'.$vehicle->main_image);
                    $usedVehicle->v_id = $vehicle->id;
                    if($usedVehicle->save()){
                        return $this->redirect(['view', 'id' => $vehicle->id]);
                    }
                }
            }
           
        }

        return $this->render('create', [
            'vehicle' => $vehicle,
            'usedVehicle' => $usedVehicle
        ]);
    }

    /**
     * Updates an existing UsedVehicles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $vehicle = Vehicles::findOne($id);
        $vehicle->scenario = "update";
        $used = UsedVehicles::find()->where(['v_id'=>$id])->all();
        $usedVehicle = UsedVehicles::findOne($used[0]->id);
        $curr_image = $vehicle->main_image;
        if ($vehicle->load(Yii::$app->request->post())) {
            if($usedVehicle->load(Yii::$app->request->post())){
                $vehicle->imageFile = UploadedFile::getInstance($vehicle,'imageFile');
                $vehicle->created_at = time();
                $vehicle->updated_at = time();
                if(!empty($vehicle->imageFile)){
                    $vehicle->main_image = $vehicle->imageFile;
                    $imageName = $vehicle->main_image;

                    $valid1 = $vehicle->validate();
                    $valid2 = $usedVehicle->validate();
                    if($valid1 && $valid2 && $vehicle->save()){
                        
                        $usedVehicle->v_id = $vehicle->id;
                        
                        $vehicle->imageFile->saveAs(Yii::getAlias('uploads/vehicles_images/').$imageName);
                        if($usedVehicle->save()){
                            return $this->redirect(['view', 'id' => $vehicle->id]);
                        }
                    }
                }else{
                    $vehicle->main_image = $curr_image;
                    $imageName = $vehicle->main_image;
                    $valid1 = $vehicle->validate();
                    $valid2 = $usedVehicle->validate();
                    if($valid1 && $valid2 && $vehicle->save()){
                        
                        $usedVehicle->v_id = $vehicle->id;
                        
                        if($usedVehicle->save()){
                            return $this->redirect(['view', 'id' => $vehicle->id]);
                        }
                    }
                }
            }
            return $this->redirect(['view', 'id' => $vehicle->id]);
        }

        return $this->render('update', [
            'vehicle' => $vehicle,
            'usedVehicle'=>$usedVehicle
        ]);
    }

    /**
     * Deletes an existing UsedVehicles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=Vehicles::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsedVehicles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsedVehicles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsedVehicles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
