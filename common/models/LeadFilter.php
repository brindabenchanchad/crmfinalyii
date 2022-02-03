<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Lead;
use common\models\Person;

class LeadFilter extends Lead
{
    /**
     * {@inheritdoc}
     */
    public $firstname;
    public $email_id;
    public $contact_no;
    public $city;
    public $person_id;
    public $created_at;
    
    public function rules()
    {
        return [
            [['lead_id'], 'integer'],
            [['firstname'], 'string'],
            [['person_id','created_at','firstname','email_id','contact_no','city'], 'safe'],
        ];
    }
  
}