<?php

namespace frontend\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
// use common\models\Customer;
use common\models\Employee;
use common\models\Person;
use common\models\Address;
use common\models\TaskSearch;
use frontend\controllers\BaseController;
    
class TaskController extends BaseController
{
/**
 * List of allowed domains.
 * Note: Restriction works only for AJAX (using CORS, is not secure).
 *
 * @return array List of domains, that can access to this API
 */

public $modelClass = 'common\models\TaskSearch';
        public function actionIndex()
        {
            // echo "working";
            // die;
            $searchModel = new TaskSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
        }

        public function actionCreate()
        {
             $task = new Task();
             $task->load(Yii::$app->getRequest()->getBodyParams(),'');
            //  print_r('test');
            //  die;
                $task->save();
                    return $task;
        }
    
        public function actionUpdate($id)
        {
            $task = Task::findOne($id);
            // $person = Person::findOne($customer->person_id);
            $employee = Employee::findOne($task->employee_id);
            $person = Person::findOne($employee->person_id);
            

            if($person->load(Yii::$app->getRequest()->getBodyParams(),'')) 
            {
                if($employee->load(Yii::$app->getRequest()->getBodyParams(),'')) 
                {
                    $person->save();
                    $employee->save();
                    return "Edited sucessfully";
                }
            }
            return "Edition failed.. try again";
        }

            public function actionDelete($id)
            {
                $task = Task::findOne($id);
                $task->is_deleted = 1;
                $task->save();
                return "Deleted successfully";
            }

            public function actionView($id)
            {
                // echo"working";
                // die;
            $task = TaskSearch::findOne($id);
            return $task;
            }
}   
?>