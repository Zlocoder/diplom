<?php
namespace app\admin;

class Module extends \yii\base\Module {
    public function init() {
        parent::init();

        \Yii::configure($this, require 'config.php');

        \Yii::$app->i18n->translations['admin'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@admin/translations'
        ];

        \Yii::$app->urlManager->addRules([
            'admin' => 'admin/dashboard/default',
            'admin/login' => 'admin/auth/login',
            'admin/<controller>s' => 'admin/<controller>/default',
            'admin/<controller>/<id:\d+>' => 'admin/<controller>/view',
            'admin/<controller>/<id:\d+>/<action>' => 'admin/<controller>/<action>',
        ]);
    }
}