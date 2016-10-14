<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Department;
use frontend\models\Company;
use frontend\models\Branches;
use frontend\models\DepartmentSearch;
use yii\filters\VerbFilter;
use  yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class DepartmentController extends Controller
{
    public function behaviors(){
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
                 'delete' => ['post']
             ]
        ]
        ];
    }
    
    /**
    *Lists all Department
    *@return mixed
    */
    
    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
    *Create a new Department
    *if creation is successfull ,will be redirected to 'view' page.
    *@return mixed
    */
    
    
    public function actionCreate(){
         if(Yii::$app->request->isAjax == false){
            $this->redirect('index');
        }
        
        if(Yii::$app->user->can('createDepartment')){
            $department = new Department();
            
            if($department->load(Yii::$app->request->post())){
                    Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                    return array('status' => $department->save());
                // return $this->redirect(['view','id'=>$department->dept_id]);
            }
            else{
                return $this->renderAjax('create',['model'=>$department,'company'=>Company::findAllCompanies()
                ,'branch'=>Branches::findAllBranches()]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }
    
    /**
    *display single Department
    *@return mixed
    */
    
    
    public function actionView($id){
        return $this->render('view',[
        'model' => Department::findDepartment($id),
        'company'=>Company::findAllCompanies()
        ]);
    }
    
    /**
    *update an existing Department.
    *if update is successfull, will be redirected to 'view' page
    *@param integer $id
    *@return mixed
    */
    
    
    public function actionUpdate($id){
          if(Yii::$app->user->can('updateDepartment')){
            $model = Department::findDepartment($id);
            
            if($model->load(Yii::$app->request->post()) && $model->save()){
                
                return $this->redirect(['view','id'=>$model->dept_id]);
            }
            else{
                return $this->render('update',[
                'model' => Department::findDepartment($id),
                'company'=>Company::findAllCompanies(),
                'branches' => Branches::findAllBranches()
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }
    
    /**
    *delete an existing Department.
    *if delet is successfull, will be redirected to 'index' page
    *@param integer $id
    *@return mixed
    */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteDepartment')){
            return Yii::$app->helper->JsonResponse(['status' => Department::findDepartment($id)->delete()]); 
            // return $this->redirect(['index']);
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }        
    }

    
    /**
    *finds all branches related to a company
    *@param integer $id
    *@return mixed
    */
    public function actionGetCompanyBranches(){
        if($id = Yii::$app->request->post('id')){
            $model = Branches::find()
                ->where(['company_id' => $id])
                ->orderBy('branch_name')
                ->all();

            if($model != null){
                echo '<option value="">Select Branch</option>';
                foreach($model as $each){
                    echo '<option value="'.$each->branch_id.'">'.$each->branch_name.'</option>';
                }
            }
            else{
                echo '<option value="">No records</option>';
            }
        }
    }
    
}