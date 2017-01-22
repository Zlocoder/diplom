<?php
use yii\web\UrlManager;
$config = [
    'id' => 'fl-step',
    'name' => 'Fl-Step',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(__DIR__) . '/../vendor',
    'sourceLanguage' => 'ru-RU',
    'language' => 'ru-RU',
    'aliases' => [
        '@admin' => dirname(__DIR__) . '/modules/admin'
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '123',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'view' => [
            'class' => 'app\components\View'
        ]
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\admin\Module',
        ],
        'site' => [
            'class' => 'app\site\Module'
        ]
    ],
    'bootstrap' => ['admin', 'site'],
    'params' => require(__DIR__ . '/params.php'),
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

return $config;
