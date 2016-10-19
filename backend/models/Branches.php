<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;
use yii\web\NotFoundHttpException;

/**
* This is the model class for table "branches".
*
* @property integer $branch_id
* @property integer $company_id
* @property string $branch_name
* @property string $branch_address
* @property string $branch_created_date
* @property string $branch_status
*
* @property Company $company
* @property Department[] $departments
*/
class Branches extends \yii\db\ActiveRecord
{
    public $company_name;
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'branches';
    }
    
    public function behaviors()
    {
        return [
        [
        'class' => TimestampBehavior::className(),
        'createdAtAttribute' => 'branch_created_date',
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
        [[ 'branch_name', 'branch_address', 'branch_status'], 'required'],
        ['company_id','required','message'=>'Company can not be blank'],
        [['company_id'], 'integer'],
        [['branch_name', 'branch_address', 'branch_created_date', 'branch_status','company_name','company_id'], 'safe'],
        [['branch_status'], 'string'],
        [['branch_name', 'branch_address'], 'string', 'max' => 255],
        [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'company_id']],
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
        'branch_id' => 'Branch ID',
        'company_id' => 'Company Name',
        'branch_name' => 'Branch Name',
        'branch_address' => 'Branch Address',
        'branch_created_date' => 'Branch Created Date',
        'branch_status' => 'Branch Status',
        ];
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['company_id' => 'company_id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['branch_id' => 'branch_id']);
    }
    
    /**
    * Finds all Branches  order by Branch Name.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @return Branches model
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function findAllBranches(){
        if(($model=Branches::find()->orderBy('branch_name')->all()) !== null){
            return $model;
        }
        else{
            throw new NotFoundHttpException;
        }
    }
}