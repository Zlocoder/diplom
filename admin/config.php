<?php

return [
    'basePath' => __DIR__,
    'viewPath' => __DIR__ . '/views',
    'layout' => 'main',
    'aliases' => [
        '@admin' => '@app/admin',
    ],
    'components' => [
        'view' => [
            'class' => 'yii\web\View'
        ]
    ]
];