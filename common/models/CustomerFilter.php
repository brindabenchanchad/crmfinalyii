<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Customer;
use common\models\Person;
use common\models\Opportunity;
use common\models\Address;



class CustomerFilter extends Customer
{
    public $customer_id;
    public $firstname;
    public $lastname;
    public $contact_no;
    public $email_id;
    public $city;
    public $created_at;
    public $opportunity_id;


    public function rules()
    {
        return [

            [['customer_id','opportunity_id'], 'integer'],
            [['firstname'],'string'],
            [['firstname','lastname','email_id','contact_no','city','created_at'],'safe'],
        ];
    }
  
}