<?php

namespace backend\controllers;

use Yii;
use backend\models\Branches;
use backend\models\BranchesSearch;
use backend\models\Company;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use  yii\filters\AccessControl;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','update','delete','create'],
                'rules' => [
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','view','update','delete','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'company'=>Company::findAllCompanies()
        ]);
    }

    /**
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(Yii::$app->request->isAjax == false){
            $this->redirect('index');
        }
        
        if(Yii::$app->user->can('createBranch')){
            $model = new Branches();
            if ($model->load(Yii::$app->request->post())) {
                    Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                    return array('status' => $model->save());
                // return $this->redirect(['view', 'id' => $model->branch_id]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                    'company'=>Company::findAllCompanies()
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }        
     }


    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('updateBranch')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->branch_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'company'=>Company::findAllCompanies()
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }        
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteBranch')){    
            return Yii::$app->helper->JsonResponse(['status' => $this->findModel($id)->delete()]);
            // return $this->redirect(['index']);
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }        
    }

    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
