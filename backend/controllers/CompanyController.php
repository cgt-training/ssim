<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use  yii\filters\AccessControl;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data =  [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('index',$data);
        }
        else{
            return $this->render('index',$data);
        }
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a list of all companies with their logo
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [ 'pageSize' => 10 ];

        return $this->renderAjax('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(Yii::$app->request->isAjax == false){
            $this->redirect('index');
        }
        
        if(Yii::$app->user->can('createCompany')){
            $model = new Company();

            if ($model->load(Yii::$app->request->post())) {
                $uploaded_logo = $model->upload();
                if(!empty($uploaded_logo)){
                    $model->logo = $uploaded_logo;
                }
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return array('status' => $model->save());
                // return $this->redirect(['view', 'id' => $model->company_id]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('updateCompany')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $uploaded_logo = $model->upload();
                if(!empty($uploaded_logo)){
                    $model->logo = $uploaded_logo;
                }
                
                return Yii::$app->helper->JsonResponse(['status' => $model->save(),'view' => $this->renderAjax('view', ['model' => $model])]);
                // return $this->redirect(['view', 'id' => $model->company_id]);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }        
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteCompany')){
            return Yii::$app->helper->JsonResponse(['status' => $this->findModel($id)->delete()]);
            // return $this->redirect(['index']);
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }        
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
