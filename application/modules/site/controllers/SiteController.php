<?php

namespace app\controllers;

use yii\web\ErrorAction;


// Контроллер по умолчанию
class SiteController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '/error'
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('/index');
    }
}