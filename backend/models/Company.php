<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\db\Query;

/**
* This is the model class for table "company".
*
* @property integer $company_id
* @property string $company_name
* @property string $company_email
* @property string $company_address
* @property string $company_created_date
* @property string $company_status
*
* @property Department[] $departments
* @property Branches[] $branches
*/
class Company extends \yii\db\ActiveRecord
{
    public $file;
    public $allowedExtensions = ['jpg','png'];
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'company';
    }
    
    public function behaviors()
    {
        return [
        [
        'class' => TimestampBehavior::className(),
        'createdAtAttribute' => 'company_created_date',
        'updatedAtAttribute' => false,
        'value' => new Expression('NOW()'),
        ],
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
        [['company_name', 'company_email', 'company_address', 'company_status','registration_date'], 'required'],
        [['company_status'], 'string'],
        [['company_name', 'company_email', 'company_address','logo'], 'string', 'max' => 255],
        ['registration_date','safe'],
        [['file'], 'file',]
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
        'company_id' => 'Company ID',
        'company_name' => 'Company Name',
        'company_email' => 'Company Email',
        'company_address' => 'Company Address',
        'company_status' => 'Company Status',
        'registration_date' => 'Registration Date',
        'logo' => 'Company Logo'
        ];
    }
    
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['company_id' => 'company_id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['company_id' => 'company_id']);
    }
    
    /**
    * Finds all  Companies order by Company Name
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @return Company  model
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function findAllCompanies(){
        if(($model=Company::find()->orderBy('company_name')->all()) !== null){
            return $model;
        }
        else{
            throw new NotFoundHttpException;
        }
    }

  /**
    * Upload company logo
    * @return file name if true otherwise false
    */
    public function upload(){
        if($this->validate()){
           $this->file = UploadedFile::getInstance($this,'file');
            if(!empty($this->file) && in_array($this->file->extension,$this->allowedExtensions)){
                $image  = $this->company_id.'.'.$this->file->extension;
                $this->file->saveAs('uploads/company_logo/'.$image);
                return $image;
            }
            else{
                Yii::$app->session->setFlash('invalidImageExtension','Invalid file type, upload only jpg and png images.');
            }
        }
        else {
            return false;
        }
    }

    // /**
    // *return all company count
    // *@return  mixed
    // */
    // public function findCompanyCount(){
    //     Query->select('count(id)')
    // }
    
}