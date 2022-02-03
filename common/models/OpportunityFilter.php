<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Opportunity;

class OpportunityFilter extends Opportunity
{
    /**
     * {@inheritdoc}
     */
    public $opportunity_id;
    public $lead_id;
    public $person_id;
    public $plan_id;
    
    public function rules()
    {
        return [
            [['opportunity_id','lead_id','person_id','plan_id'], 'integer'],
            [['lead_id','person_id','plan_id'], 'safe'],
        ];
    }
  
}
