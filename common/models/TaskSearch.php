<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;
use common\models\Person;
use common\models\TaskFilter;
// use common\models\Opportunity;
use yii\data\ActiveDataFilter;

class TaskSearch extends Task
{
    
    public function fields()
{
	return [
		'task_id',
        'task_name',
        'task_description',
        'task_date',
        'employee_id',
        'module_id',
        'module_name',
        'created_at',
        
      
	'employee' => function($model){
        // print_r($model->opportunity);
        // die;
		return $model->task->employee;
		},
        // 'address' => function($model){
        //             // print_r($model->opportunity);
        //             // die;
        //             return $model->opportunity->person->address;
        //             },
        // 'plan' => function($model){
        //     return $model->plan;
        //     },
	];

}
    // public $opportunity_id;
 
    public function rules()
    {
        return [
            [['task_id','employee_id','module_id'], 'required'],
            [['task_id','employee_id','module_id'], 'integer'],
           
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
            'searchModel' => 'common\models\TaskFilter',
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
        $query->joinWith(['employee']);
        $query->where('is_deleted = 0');
        $query->andFilterWhere([
            'employee.employee_id'=>$this->employee_id,
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
        $query = Task::find();

        $dataProvider->setSort([
            'attributes' => [
                'task_id',
                'task_name',
                'task_description',
                'task_date',
                'task_status',
                'employee_id',
                'module_id',
                'module_name',
                'created_at',
                'updated_at',
                
                'taskname' => [
                    'asc' => ['taskname' => SORT_ASC],
                    'desc' => ['taskname' => SORT_DESC],
                    'label' => 'Task Name',
                    'default' => SORT_ASC
                ],
                // 'firstname' => [
                //     'asc' => ['person.firstname' => SORT_ASC],
                //     'desc' => ['person.firstname' => SORT_DESC],
                //     'label' => 'Employee Name',
                //     'default' => SORT_ASC
                // ],
            ],
        ]);

        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'task_id' => $this->task_id,
            'module_id' => $this->module_id,
            'module_name' => $this->module_name,
           
            // 'create_date' => $this->create_date,
        ]);


        return $dataProvider;
    }  
}

