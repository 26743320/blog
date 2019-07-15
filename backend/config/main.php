<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        "rbac" => [        
            'class' => 'rbac\Module',
        ],
        "system" => [        
            'class' => 'system\Module',
        ],
        "backup" => [        
            'class' => 'backup\Module',
        ],
    ],
    "aliases" => [    
        '@rbac' => '@backend/modules/rbac',
        '@system' => '@backend/modules/system',
        '@backup' => '@backend/modules/backup',
    ],
    'components' => [
        'db' => [
            // 'class' => 'yii\db\Connection',
            // 'dsn' => 'mysql:host=39.105.39.169;dbname=s_blog',
            // 'username' => 'root',
            // 'password' => 'Snail*123456',
            // 'charset' => 'utf8',
            'tablePrefix'=>"t_"
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
           // 'baseUrl' => '/', // 修改 baseUrl
        ],
        'user' => [
            'identityClass' => 'rbac\models\User',
            'loginUrl' => array('/rbac/user/login'),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        // ],
        "authManager" => [        
            "class" => 'yii\rbac\DbManager',   
            "defaultRoles" => ["guest"],    
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        "urlManager" => [       
            "enablePrettyUrl" => true,        
            "enableStrictParsing" => false,     
            "showScriptName" => false,       
            "suffix" => "",    
            "rules" => [        
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",  
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"    
            ],
        ],
        //打开路由美化
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        //     'rules' => [],
        // ],
    ],
    'as access' => [
        'class' => 'rbac\components\AccessControl',
        'allowActions' => [
            'rbac/user/request-password-reset',
            'rbac/user/reset-password'
        ]
    ],
    'params' => $params,
];
