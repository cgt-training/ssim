<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;


/**
* This is the model class for table "user".
*
* @property integer $id
* @property string $username
* @property string $auth_key
* @property string $password_hash
* @property string $password_reset_token
* @property string $email
* @property integer $status
* @property string $image
* @property integer $created_at
* @property integer $updated_at
*/
class User extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'user';
    }
    
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
        [['username', 'email'], 'required'],
        [['status', 'created_at', 'updated_at'], 'integer'],
        [['username', 'password_hash', 'password_reset_token', 'email','image'], 'string', 'max' => 255],
        [
        ['username', 'email'],
        'unique',
        'when' => function ($model, $attribute) {
            return $model->{$attribute} !== $model->getOldAttribute($attribute);
        },
        'on' => 'update'
        ],
        [['file'], 'file',]
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'username' => 'Username',
        'email' => 'Email',
        'status' => 'Status',
        'image' => 'Image',
        ];
    }
    
    /**
    * Upload Profile photo
    * @return file name if true otherwise false
    */
    public function upload(){
        if($this->validate()){
            $this->file->saveAs('images/'.$this->id.'.'.$this->file->extension);
            return true;
        }
        else {
            return false;
        }
    }
    
       /**
    * Finds a User
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @return User  model
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function getUser($id){
        if(($model = User::findOne($id)) !== null){
            return $model;
        }
        else{
            throw new NotFoundHttpException;
        }
    }
}