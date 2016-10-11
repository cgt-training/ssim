<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Department;
use frontend\models\Company;
use frontend\models\Branches;
use frontend\models\DepartmentSearch;
use yii\filters\VerbFilter;

class DepartmentController extends Controller
{
    public function behaviors(){
        return [
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
        $department = new Department();
        
        if($department->load(Yii::$app->request->post()) && $department->save()){
            return $this->redirect(['view','id'=>$department->dept_id]);
        }
        else{
            return $this->render('create',['model'=>$department,'company'=>Company::findAllCompanies()
            ,'branch'=>Branches::findAllBranches()]);
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
    
    /**
    *delete an existing Department.
    *if delet is successfull, will be redirected to 'index' page
    *@param integer $id
    *@return mixed
    */
    public function actionDelete($id)
    {
        Department::findDepartment($id)->delete();
        
        return $this->redirect(['index']);
    }
    
}