<?php

return [
    'basePath' => __DIR__,
    'viewPath' => __DIR__ . '/views',
    'layout' => 'main',
    'defaultRoute' => 'dashboard/default',
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\admin\models\Administrator',
            'loginUrl' => ['admin/auth/login'],
            'idParam' => '__admin_user_id',
            'authTimeout' => 1800
        ]
    ]
];