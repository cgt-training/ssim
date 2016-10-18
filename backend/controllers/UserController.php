<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\UploadedFile;

class UserController extends Controller
{
    
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
    
}