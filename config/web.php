<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Bofort',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'dua_LLZMx3EyGin1WsXrVydM2eODdC6c',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'user' => [
            'class' => 'amnah\yii2\user\components\User',
            'identityClass' => 'app\models\User',
            'loginUrl' => ['site/index']
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/amnah/yii2-user/views' => '@app/views/user',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.beget.com',
                'username' => (YII_ENV == 'production') ? 'reply@bofort.ru' : 'reply@bofort.su',
                'password' => (YII_ENV == 'production') ? 'o96Mv*Aa' : 'Qwerty123',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'from' => (YII_ENV == 'production') ? 'reply@bofort.ru' : 'reply@bofort.su'
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 0 : 0,
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['app.*'],
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => [],
                    'exportInterval' => 1,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logVars' => [],
                    'exportInterval' => 1,
                    'logFile' => '@runtime/logs/errors.log'
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin/promo' => 'promo/index',
                'admin/actions/<action:(create|update|index|delete)>' => 'actions/<action>',
                'admin/boats/create' => 'boats/create',
                'admin/services' => 'services/index',
                'admin/users' => 'user/admin',
                'admin/category/<action:(create|update|index)>' => 'category/<action>',
                'boats/show/<slug>' => 'boats/slug',
                'boats/index/<slug>' => 'boats/index',
                'admin/notifications/<action:(create|index)>' => 'notifications/<action>'
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
            'controllerMap' => [
                'default' => 'app\controllers\DefaultController',
            ],
            'modelClasses'  => [
                'Profile' => 'app\models\Profile',
                'Role' => 'app\models\Role'
            ],
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['192.168.10.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
