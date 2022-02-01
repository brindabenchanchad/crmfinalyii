<?php
    namespace frontend\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
// use common\models\Customer;
// use common\models\CustomerSearch;
use frontend\controllers\baseController;
    
class OpportunityController extends BaseController
{
/**
 * List of allowed domains.
 * Note: Restriction works only for AJAX (using CORS, is not secure).
 *
 * @return array List of domains, that can access to this API
 */

public $modelClass = 'common\models\OpportunitySearch';
        public function actionIndex()
        {
            $searchModel = new OpportunitySearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
        }

        public function actionCreate()
        {
             $opportunity = new Opportunity();
             $opportunity->load(Yii::$app->getRequest()->getBodyParams(),'');
                $opportunity->save();
                    return $opportunity;
        }
    
         public function actionUpdate($id) {
    
            $opportunity = Opportunity::findOne($id);
            if ($opportunity->load(Yii::$app->getRequest()->getBodyParams(), '')){
            
                  echo "Updated successfully ";
                  $opportunity->save();
             }
            }
             public function actionDelete($id)
             {
                 // echo $id;
                 $opportunity = Opportunity::findOne($id);
     
                 if($opportunity->load(Yii::$app->getRequest()->getBodyParams(),'')) 
                 {
                     $opportunity->save();
                     return "Deleted sucessfully";
                 }
                     return "Deletion failed.. try again";
             }

}   
?>