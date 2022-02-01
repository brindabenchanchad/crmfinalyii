<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Customer;


class CustomerFilter extends Customer
{
    public $customer_id;
    public $opportunity_id;


    public function rules()
    {
        return [

            [['customer_id','opportunity_id'], 'integer'],
        ];
    }
  
}