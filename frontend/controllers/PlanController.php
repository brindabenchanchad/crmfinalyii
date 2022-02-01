<?php

    namespace frontend\controllers;
    use Yii;
    use yii\rest\ActiveController;
    use common\models\Plan;
    use common\models\PlanSearch;
    use yii\filters\auth\HttpBasicAuth;
    use frontend\controllers\baseController;


    class PlanController extends BaseController
    {
        public $modelClass = 'common\models\PlanSearch';
        public function actionIndex()
        {
             $searchModel = new PlanSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
  
            return $dataProvider;
        }
        public function actionCreate()
        {
             $plan = new Plan();
             $plan->load(Yii::$app->getRequest()->getBodyParams(),'');
                $plan->save();
                    return $plan;
        }
        public function actionDelete($id)
        {
            // echo $id;
            $plan = Plan::findOne($id);

            if($plan->load(Yii::$app->getRequest()->getBodyParams(),'')) 
            {
                $plan->save();
                return "Edited sucessfully";
            }
                return "Edition falied.. try again";
        }
    }
?>