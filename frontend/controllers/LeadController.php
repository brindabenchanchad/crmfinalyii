<?php
    namespace frontend\controllers;
    use Yii;
    use yii\rest\ActiveController;
    use common\models\Lead;
    use common\models\LeadSearch;
    use common\models\Person;
    use common\models\Address;
    use yii\filters\auth\HttpBasicAuth;
    use frontend\controllers\BaseController;

    class LeadController extends BaseController
    {
        public $modelClass = 'common\models\LeadSearch';

        public function actionIndex()
        {
            $searchModel = new LeadSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
  
            return $dataProvider;
        // }
        }

        public function actionCreate()
        {
            $address = new Address();
            $address->load(Yii::$app->getRequest()->getBodyParams(),'');
            $address->save();

            $person = new Person();
            $person->load(Yii::$app->getRequest()->getBodyParams(),'');
            $person->address_id = $address->address_id;
            $person->save();

            $lead = new Lead();
            $lead->person_id = $person->person_id;
            $lead->save();

            return $lead;
        }

        public function actionUpdate($id)
        {
            $lead = Lead::findOne($id);
            $person = Person::findOne($lead->person_id);
            $address = Address::findOne($person->address_id);

            if($person->load(Yii::$app->getRequest()->getBodyParams(),'')) 
            {
                if($address->load(Yii::$app->getRequest()->getBodyParams(),'')) 
                {
                    $person->save();
                    $address->save();
                    return "Edited sucessfully";
                }
            }
            return "Edition falied.. try again";
        }

        public function actionDelete($id)
        {
            $lead = Lead::findOne($id);
            $lead->is_deleted = 1;
            $lead->save();
            return "Deleted successfully";
        }

        
        
    }   
?>