<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "department".
 *
 * @property integer $dept_id
 * @property integer $company_id
 * @property integer $branch_id
 * @property string $dept_name
 * @property string $dept_created_date
 * @property string $dept_status
 *
 * @property Company[] $company
 * @property Branches[] $branches
 */

class Department extends ActiveRecord 
{
	public static function tableName(){
		return 'department';
	}

	public function behaviors(){
		return [
				[
			    'class' => TimestampBehavior::className(),
			    'createdAtAttribute' => 'dept_created_date',
			    'updatedAtAttribute' => false,
			    'value' => new Expression('NOW()'),
			],
		];
	}

	public function rules(){
		return [
			[['dept_name','dept_status','branch_id','company_id'],'required'],
			[['dept_status'],'string']
		];
	}

	public function attributeLabels(){
		return [
			'dept_name' => 'Department Name',
			'dept_status' => 'Department Status',
			'branch_id' => 'Branch',
			'company_id' => 'Company',
			'dept_created_date' => 'Date Created'
		];
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany(){
    	return $this->hasOne(Company::className(),['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches(){
    	return $this->hasOne(Branches::className(),['branch_id' => 'branch_id']);
    }

    /**
     * Finds the Department  model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department  model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findDepartment($id){
    	if(($model=Department::findOne($id)) !== null){
			return $model;
		}
		else{
			throw new NotFoundHttpException;
		}
    }
}