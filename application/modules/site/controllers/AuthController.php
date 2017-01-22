<?php

namespace app\controllers;

use yii;

class AuthController extends BaseController {
    public function actionRegistration() {
        $registrationForm = new \app\models\forms\RegistrationForm();
        if (Yii::$app->request->isPost) {
            $registrationForm->load(Yii::$app->request->post());
            $registrationForm->photo = \yii\web\UploadedFile::getInstance($registrationForm, 'photo');

            if ($user = $registrationForm->registerUser()) {
                Yii::$app->user->login($user);
                $this->goBack();
            }
        }

        return $this->render('/registration', ['registrationForm' => $registrationForm]);
    }

    public function  actionLogin() {
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        $this->goBack();
    }
}