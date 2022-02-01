<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Lead;
use common\models\Person;
use yii\data\ActiveDataFilter;

class LeadSearch extends Lead
{
    /**
     * {@inheritdoc}
     */
    public function fields() {
        return ['lead_id'];
    }

    public $firstname;
 
    public function rules()
    {
        return [
            [['lead_id'], 'integer'],
            [['firstname'], 'string'],
            [['person_id', 'created_at', 'firstname'], 'safe'],
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
            'searchModel' => 'common\models\LeadFilter',
            'attributeMap' => [
                'person_id' => 'person.person_id',
            ],
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
        $query = Lead::find();
        $query->joinWith(['person']);
       
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort([
            'attributes' => [
                'lead_id',
                'created_at',
                'person_id',
                'firstname' => [
                    'asc' => ['firstname' => SORT_ASC],
                    'desc' => ['firstname' => SORT_DESC],
                    'label' => 'Person Name',
                    'default' => SORT_ASC
                ]
            ],
        ]);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'lead_id' => $this->lead_id,
            'person_id' => $this->person_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }

    public function getPerson() {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }

}