<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

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
            [['company_name', 'company_email', 'company_address'], 'string', 'max' => 255],
            ['registration_date','safe']
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
            'registration_date' => 'Registration Date'
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

}
