<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Plan;

class PlanFilter extends Plan
{
    /**
     * {@inheritdoc}
     */
    public $plan_id;
    public $plan_name;
    public $plan_duration;
    public $plan_price;
    public $plan_description;
    
    public function rules()
    {
        return [
            [['plan_id','plan_price'], 'integer'],
            [['plan_name','plan_duration','plan_description','plan_price'], 'safe'],
        ];
    }
  
}
