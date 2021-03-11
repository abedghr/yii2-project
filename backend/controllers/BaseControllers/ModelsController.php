<?php

namespace backend\controllers\BaseControllers;

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
class ModelsController extends Controller
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
        $model = new Models();
        $makes = Yii::$app->db->createCommand('SELECT id,m_name FROM make')->queryAll();
        
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model,'model_logo');
            $imgName = time().'_'.$image;
            $model->model_logo = $imgName;
            if($model->validate()){
                /* $image = UploadedFile::getInstance($model,'model_logo');
                $imgName = time().'_'.$image; */
                $image->saveAs(Yii::getAlias('uploads/models_images').'/'.$imgName);
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
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
        $formData = Yii::$app->request->post();
        $Curr_file = $model->model_logo;
        if($model->load(Yii::$app->request->post())){
            $file =UploadedFile::getInstance($model,'model_logo');
            if(!empty($file)){
                $imageName = time().'_'.$file;
                $file->saveAs(Yii::getAlias('uploads/models_images').'/'.$imageName);
                $model->model_logo = $imageName;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
                $imageName = $Curr_file;
                $model->model_logo = $imageName;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
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
