<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'enableStrictParsing'=>true,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 
                'controller' => 'customer',
                'extraPatterns' => [
                    'OPTIONS,DELETE delete/{id}' => 'delete',
                    'OPTIONS,PUT update/{id}' => 'update',
                    // 'OPTIONS,GET reject/{id}' => 'reject',
                    // 'OPTIONS,POST initialize-content/{id}' => 'initialize-content',
                    // 'OPTIONS,GET ready-for-approval/{id}' => 'ready-for-approval',
                    // 'OPTIONS,GET submit-for-approval/{id}' => 'submit-for-approval',
                    // 'OPTIONS,DELETE delete-collection/{id}' => 'delete-collection',
                    // 'OPTIONS,GET check-submit-for-approval/{id}' => 'check-submit-for-approval',
                    // 'OPTIONS,POST add-collection-content/{id}' => 'add-collection-content',
                    // 'OPTIONS,POST update-collection/{id}' => 'update-collection',
                    // 'OPTIONS,PUT update-content/{id}' => 'update-content',
                ],
            ],
            ],
        ],
        
        [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'plan',
                    'extraPatterns' => [
                        'OPTIONS,DELETE delete/{id}' => 'delete',
                        // 'OPTIONS,GET reject/{id}' => 'reject',
                        // 'OPTIONS,POST initialize-content/{id}' => 'initialize-content',
                        // 'OPTIONS,GET ready-for-approval/{id}' => 'ready-for-approval',
                        // 'OPTIONS,GET submit-for-approval/{id}' => 'submit-for-approval',
                        // 'OPTIONS,DELETE delete-collection/{id}' => 'delete-collection',
                        // 'OPTIONS,GET check-submit-for-approval/{id}' => 'check-submit-for-approval',
                        // 'OPTIONS,POST add-collection-content/{id}' => 'add-collection-content',
                        // 'OPTIONS,POST update-collection/{id}' => 'update-collection',
                        // 'OPTIONS,PUT update-content/{id}' => 'update-content',
                    ],
                ],
    ],

    
    'params' => $params,
];
