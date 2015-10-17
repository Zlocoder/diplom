<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Competition;

class SiteController extends Controller
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