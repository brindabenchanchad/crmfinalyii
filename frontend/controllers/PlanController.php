<?php
    namespace frontend\controllers;
    use yii\rest\ActiveController;
    use yii\filters\auth\HttpBasicAuth;
    
    class PlanController extends ActiveController
    {
      
        public $modelClass = 'common\models\Plan';

        /**
 * List of allowed domains.
 * Note: Restriction works only for AJAX (using CORS, is not secure).
 *
 * @return array List of domains, that can access to this API
 */


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];
        
        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

        public function actions()
        {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
        'class' => \yii\data\ActiveDataFilter::class,
        'searchModel' => 'common\models\Plan',
    ];

    return $actions;
    }
    }   
?>