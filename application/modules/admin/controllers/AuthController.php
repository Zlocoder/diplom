<?php

namespace app\admin\controllers;

class AuthController extends BaseController {
    public $layout = false;

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['access']['except'] = ['login'];

        return $behaviors;
    }

    public function actionLogin() {
        $loginForm = new \app\admin\models\forms\Login();

        if (\Yii::$app->request->isPost) {
            $loginForm->load(\Yii::$app->request->post());

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($loginForm);
            }

            if ($loginForm->validate()) {
                $this->module->user->login($loginForm->administrator);
                $this->redirect($this->module->user->returnUrl);
            }
        }

        return $this->render('/login', ['loginForm' => $loginForm]);
    }

    public function actionLogout() {

    }
}