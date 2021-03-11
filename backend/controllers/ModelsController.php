<?php

namespace backend\controllers;

use backend\controllers\BaseControllers\ModelsController as BaseControllersModelsController;
use common\models\Make;
use Yii;
use common\models\Models;
use common\models\ModelsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ModelsController implements the CRUD actions for Models model.
 */
class ModelsController extends BaseControllersModelsController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Models models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModelsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Models model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Models model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Models(['scenario'=>Models::SCENARIO_CREATE]);
        $makes = Yii::$app->db->createCommand('SELECT id,m_name FROM make')->queryAll();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model,'imageFile');
            $model->model_logo = time().'_'.$model->imageFile;
            $imageName = $model->model_logo;
            if($model->validate() && $model->save()){
                $model->imageFile->saveAs(Yii::getAlias('uploads/models_images').'/'.$imageName);
                    return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
            'makes'=>$makes
        ]);
    }

    /**
     * Updates an existing Models model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Models::findOne($id);
        $model->scenario = Models::SCENARIO_UPDATE;
        $makes = Make::find()->all();
        $Curr_file = $model->model_logo;
        if($model->load(Yii::$app->request->post())){
            $model->imageFile =UploadedFile::getInstance($model,'imageFile');
            if(!empty($model->imageFile)){
                $model->model_logo = time().'_'.$model->imageFile;
                
                if($model->validate() && $model->save()){
                    $model->imageFile->saveAs(Yii::getAlias('uploads/models_images').'/'.$model->model_logo);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
                $imageName = $Curr_file;
                $model->model_logo = $imageName;
                if($model->validate() && $model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'makes' => $makes
        ]);
    }

    /**
     * Deletes an existing Models model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Models model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Models the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Models::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
