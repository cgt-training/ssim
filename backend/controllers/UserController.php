<?php

namespace backend\controllers;

use Yii;
use app\models\User;
use backend\models\UserSearch;
use app\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data =[
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
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
             $model->file = UploadedFile::getInstance($model,'file');
            if(!empty($model->file)){
                if($model->upload()){
                    $model->image  = $model->id.'.'.$model->file->extension;
                }
            }
            
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->auth_key =  Yii::$app->security->generateRandomString();
            $model->status = 1;
            $model->save();
            User::assignRoles($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
            return $this->render('create', [
                'model' => $model,
                'auth_roles' => AuthItem::getAuthRoles()
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             $model->file = UploadedFile::getInstance($model,'file');
             
            if(!empty($model->file)){
                if($model->upload()){
                    $model->image  = $model->id.'.'.$model->file->extension;
                }
            }
            User::assignRolesAndSave($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'auth_roles' =>  AuthItem::getAuthRoles()
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

        
     /**
     * Display user profile
     * @return mixed
     */
    public function actionProfile()
    {
        $model = User::getUser(Yii::$app->user->getId());
        
        if($model->load(Yii::$app->request->post())){
            $model->file = UploadedFile::getInstance($model,'file');
            if(!empty($model->file)){
                if($model->upload()){
                    $model->image  = $model->id.'.'.$model->file->extension;
                }
            }
            $model->save();
        }
        
        $model =  User::getUser(Yii::$app->user->getId());
        return $this->render('profile',['model' =>$model]);
    }
   
    /**
     * Remove user profile image.
    * @param integer $id
     * @return mixed
     */
    public function actionRemoveImage($id){
        $model = User::getUser($id);
        
        if(!empty($model->image)){
            @unlink('uploads/'.$model->image);
            $model->image = null;
            $model->save();
        }
        return $this->redirect('profile');
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
