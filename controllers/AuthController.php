<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\UploadedFile;

use app\models\User;
use app\models\UserRegistrationForm;
use app\models\UserLoginForm;

class AuthController extends Controller {
    public function actionRegistration() {
        $userRegistrationForm = new UserRegistrationForm();

        if (Yii::$app->request->isPost) {
            $userRegistrationForm->load(Yii::$app->request->post());
            $userRegistrationForm->avatar = UploadedFile::getInstance($userRegistrationForm, 'avatar');

            try {
                if ($user = $userRegistrationForm->registrate()) {
                    Yii::$app->user->login($user);
                    $this->goHome();
                }
            } catch (yii\base\Exception $e) {
                $userRegistrationForm->addError('form', 'Ошибка регистрации');
            }

        }

        return $this->render('/registration', ['model' => $userRegistrationForm]);
    }

    public function  actionLogin() {
        $userLoginForm = new UserLoginForm();
        if (Yii::$app->request->isPost) {
            $userLoginForm->load(Yii::$app->request->post());
            try {
                if ($user = $userLoginForm->login()) {
                    Yii::$app->user->login($user);
                    $this->goHome();
                }
            } catch (yii\base\Exception $e) {
                $userLoginForm->addError('form', 'Ошибка входа');
            }
        }
        return $this->render('/login', ['model' => $userLoginForm]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        $this->goHome();
    }
}