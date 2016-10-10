<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Branches;

/**
 * BranchesSearch represents the model behind the search form about `frontend\models\Branches`.
 */
class BranchesSearch extends Branches
{
    //an attribute for Company model
	public $company_name;

    // an attribute for Branch model
	public $branch_name;

	public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['branch_name', 'company_id', 'branch_id', 'branch_created_date', 'branch_status','company_name','branch_address'], 'safe'],
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
       	$query = Branches::find()->joinWith('company');
       
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //set sorting for company relationship
        $dataProvider->sort->attributes['company_name'] = [
        	'asc' => ['company.company_name' => SORT_ASC],
        	'desc' => ['company.company_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		// grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
        ]);

        $query->andFilterWhere(['like','branch_name',$this->branch_name]);
        $query->andFilterWhere(['like','branch_address',$this->branch_address]);
        $query->andFilterWhere(['like','branch_status',$this->branch_status]);
        $query->andFilterWhere(['like','branch_created_date',$this->branch_created_date]);
        $query->andFilterWhere(['like','company.company_name',$this->company_name]);
        return $dataProvider;
    }
}
