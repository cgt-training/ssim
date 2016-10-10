<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Department;

/**
 * DepartmentSearch represents the model behind the search form about `frontend\models\Department`.
 */
class DepartmentSearch extends Department
{
    //an attribute for Company model
	public $company_name;

    // an attribute for Branch model
	public $branch_name;

	public function rules()
    {
        return [
            [['dept_id'], 'integer'],
            [['dept_name', 'company_id', 'branch_id', 'dept_created_date', 'dept_status','company_name','branch_name'], 'safe'],
        ];
    }

 	public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
    *Creates data provider instance with search query applied
    *@param array $params
    *@return ActiveDataProvider
    */
    public function search($params)
    {
        //joined with company and branches relationships
       	$query = Department::find()->joinWith('company')->joinWith('branches');
       
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //set sorting for company relationship
        $dataProvider->sort->attributes['company_name'] = [
        	'asc' => ['company.company_name' => SORT_ASC],
        	'desc' => ['company.company_name' => SORT_DESC],
        ];

        //set sorting for branches relationship
        $dataProvider->sort->attributes['branch_name'] = [
        	'asc' => ['branches.branch_name' => SORT_ASC],
        	'desc' => ['branches.branch_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		// grid filtering conditions
        $query->andFilterWhere([
            'dept_id' => $this->dept_id,
        ]);

        $query->andFilterWhere(['like','dept_status',$this->dept_status]);
        $query->andFilterWhere(['like','dept_created_date',$this->dept_created_date]);
        $query->andFilterWhere(['like','company.company_name',$this->company_name]);
        $query->andFilterWhere(['like','branches.branch_name',$this->branch_name]);
        return $dataProvider;
    }
}
