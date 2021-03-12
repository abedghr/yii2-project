<?php

namespace backend\controllers;

use backend\controllers\BaseControllers\MakeController as BaseControllersMakeController;
use Yii;
use common\models\Make;
use common\models\MakeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * MakeController implements the CRUD actions for Make model.
 */
class MakeController extends BaseControllersMakeController
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
                        'actions' => ['logout', 'index','create','update','view'],
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
     * Lists all Make models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MakeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Make model.
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
     * Creates a new Make model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Make();
        $model->scenario = Make::SCENARIO_CREATE;
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model,'imageFile');
            $model->imageFile = $file;
            $model->make_logo = time().'_'.$file->name;
            $imageName = $model->make_logo;
            if($model->validate()){
                if($model->save()){
                    $file->saveAs(Yii::getAlias('uploads/makes_images/').$imageName);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Make model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $makeModel = Make::findOne($id);
        $makeModel->scenario = Make::SCENARIO_UPDATE;
        $curr_image = $makeModel->make_logo;
        if($makeModel->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($makeModel,'imageFile');
            if(!empty($file)){
                $makeModel->imageFile = $file;
                $makeModel->make_logo = time().'_'.$file->name;
                $imageName = $makeModel->make_logo;
                if($makeModel->validate() && $makeModel->save()){
                    $file->saveAs(Yii::getAlias('uploads/makes_images/').$imageName);
                    return $this->redirect(['view', 'id' => $makeModel->id]);
                }
            }else{
                $makeModel->make_logo = $curr_image;
                if($makeModel->validate() && $makeModel->save()){
                    return $this->redirect(['view', 'id' => $makeModel->id]);
                }
            }
        }
        
        return $this->render('update', [
            'model' => $makeModel,
        ]);
    }

    /**
     * Deletes an existing Make model.
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
     * Finds the Make model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Make the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Make::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
