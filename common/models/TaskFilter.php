<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;
use common\models\Person;
// use common\models\Opportunity;
use common\models\Address;



class TaskFilter extends Customer
{
    public $task_id;
    public $task_name;
    public $task_description;
    public $task_date;
    public $employee_id;
    public $module_name;
    public $created_at; 


    public function rules()
    {
        return [

            [['task_id','employee_id','module_id'], 'integer'],
            [['task_name','task_description','module_name'],'string'],
            [['task_name','task_description','task_date','module_name','created_at'],'safe'],
        ];
    }
  
}