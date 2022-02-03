<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Opportunity;
use yii\data\ActiveDataFilter;

class OpportunitySearch extends Opportunity
{
    /**
     * {@inheritdoc}
     */
 
     public function fields() {
        return [
            'lead_id',
            'person' => function ($model) {
                return $model->person;
            },
            'address' => function ($model) {
                return $model->person->address;
            },
            'plan' => function ($model) {
                return $model->plan;
            },
        ];
    }
    public function rules()
    {
        return [
            [['opportunity_id','lead_id','person_id','plan_id'], 'integer'],
            [['lead_id','person_id','plan_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
  

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $filter = new ActiveDataFilter([
            'searchModel' => 'common\models\OpportunityFilter'
        ]);
        
        $filterCondition = null;
        
        // You may load filters from any source. For example,
        // if you prefer JSON in request body,
        // use Yii::$app->request->getBodyParams() below:
        if ($filter->load(\Yii::$app->request->get())) { 
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                // Serializer would get errors out of it
                return $filter;
            }
        }
        
        $query = Opportunity::find();
       
    
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
    //   echo  $query->createCommand()->rawSql;
        // die;
        
        return new ActiveDataProvider([
            'query' => $query,
        ]);
       
        
/*
     if ($filterCondition !== null) {
        $query->andWhere($filterCondition);
    }*/
 
 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'opportunity_id',
                'person_id',
                'plan_id',
                'lead_id',
                ],
        ]);

        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'opportunity_id' => $this->opportunity_id,
            'person_id' => $this->person_id,
            'plan_id' => $this->plan_id,
            'lead_id' => $this->lead_id,
        ]);

        $query->andFilterWhere(['like', 'person_id', $this->person_id]);

        return $dataProvider;
    }

}