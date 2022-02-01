<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Customer;
use common\models\CustomerFilter;
use common\models\Opportunity;
use yii\data\ActiveDataFilter;

class CustomerSearch extends Customer
{
    
    public function fields()
{
	return [
		'customer_id',
        'opportunity_id',
        'created_at',
        
      
	'person' => function($model){
//         // print_r($model->opportunity);
//         // die;
		return $model->opportunity->person;
		},
        'address' => function($model){
            //         // print_r($model->opportunity);
            //         // die;
                    return $model->opportunity->person->address;
                    },
        // 'plan' => function($model){
        //     return $model->plan;
        //     },
	];

}
    // public $opportunity_id;
 
    public function rules()
    {
        return [
            [['opportunity_id'], 'required'],
            [['opportunity_id'], 'integer'],
           
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        // echo('working');
        // die;
        $filter = new ActiveDataFilter([
            'searchModel' => 'common\models\CustomerFilter',
            // 'attributeMap' => [
            //     'opportunity_id' => 'opportunity.opportunity_id',
            // ],
        ]);
        
        $filterCondition = null;
       
        if ($filter->load(\Yii::$app->request->get())) { 
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                return $filter;
            }
        }
        // $this->load($params);
        // $query = Customer::find();
        $query = self::find();
        $query->joinWith(['opportunity']);
        $query->where('is_deleted = 0');
        $query->andFilterWhere([
            'opportunity.opportunity_id'=>$this->opportunity_id,
        ]);
       
    // print_r($filterCondition);
    // die;
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
  
 
 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        $query = Customer::find();

        $dataProvider->setSort([
            'attributes' => [
                'customer_id',
                'opportunity_id',
                'created_at',
                'updated_at',
                // 'person_name' => [
                //     'asc' => ['person_name' => SORT_ASC],
                //     'desc' => ['person_name' => SORT_DESC],
                //     'label' => 'Person Name',
                //     'default' => SORT_ASC
                // ]
            ],
        ]);

        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'customer_id' => $this->customer_id,
            // 'create_date' => $this->create_date,
        ]);


        return $dataProvider;
    }

    // public function getOpportunity() {
    //     return $this->hasOne(Opportunity::className(), ['opportunity_id' => 'opportunity_id']);
    // }


  
}

