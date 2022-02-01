<?php
    namespace frontend\controllers;
    use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use common\models\Customer;
use common\models\Opportunity;
use common\models\Person;
use common\models\Address;
use common\models\CustomerSearch;
use frontend\controllers\BaseController;
    
class CustomerController extends BaseController
{
/**
 * List of allowed domains.
 * Note: Restriction works only for AJAX (using CORS, is not secure).
 *
 * @return array List of domains, that can access to this API
 */

public $modelClass = 'common\models\CustomerSearch';
        public function actionIndex()
        {
            // echo "working";
            // die;
            $searchModel = new CustomerSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
        }

        public function actionCreate()
        {
             $customer = new Customer();
             $customer->load(Yii::$app->getRequest()->getBodyParams(),'');
            //  print_r('test');
            //  die;
                $customer->save();
                    return $customer;
        }
    
        public function actionUpdate($id)
        {
            $customer = Customer::findOne($id);
            // $person = Person::findOne($customer->person_id);
            $opportunity = Opportunity::findOne($customer->opportunity_id);
            $person = Person::findOne($opportunity->person_id);
            

            if($person->load(Yii::$app->getRequest()->getBodyParams(),'')) 
            {
                // if($opportunity->load(Yii::$app->getRequest()->getBodyParams(),'')) 
                // {
                    $person->save();
                    // $opportunity->save();
                    return "Edited sucessfully";
                // }
            }
            return "Edition failed.. try again";
        }

            public function actionDelete($id)
            {
                $customer = Customer::findOne($id);
                $customer->is_deleted = 1;
                $customer->save();
                return "Deleted successfully";
            }

            public function actionView($id)
            {
                // echo"working";
                // die;
            $customer = CustomerSearch::findOne($id);
            return $customer;
            }
}   
?>