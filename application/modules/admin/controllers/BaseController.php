<?php

namespace app\admin\controllers;

class BaseController extends \yii\web\Controller {
    public $defaultAction = 'default';

    public function behaviors() {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'user' => $this->module->user,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function redirect($url, $statusCode = 302) {
        if (\Yii::$app->request->isPjax) {
            parent::redirect($url, $statusCode);
            return \Yii::$app->handleRequest(new \yii\web\Request(['url' => \yii\helpers\Url::to($url)]));
        }

        return parent::redirect($url, $statusCode);
    }

    public function saveReturnUrl($url = null) {
        $this->module->user->returnUrl = $url ? $url : \Yii::$app->request->url;
    }

    public function goBack($defaultUrl = null) {
        return $this->redirect($this->module->user->getReturnUrl($defaultUrl));
    }

    public function goHome($app = true) {
        return $this->redirect($app ? \Yii::$app->defaultRoute : $this->module->defaultRoute);
    }
}