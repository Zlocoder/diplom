<?php

namespace app\admin\models\forms;

use app\admin\models\Administrator;

class Login extends \yii\base\Model {
    private $_administrator;

    public $login;
    public $password;

    public function rules() {
        return [
            ['login', 'required', 'message' => \Yii::t('admin', 'Введите логин')],
            ['login', 'string', 'min' => 4, 'max' => 128, 'tooShort' => \Yii::t('admin', 'Логин должен быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'Логин должен быть от 4 до 100 символов')],
            ['login', 'validateLogin'],
            ['password', 'required', 'message' => \Yii::t('admin', 'Введите пароль')],
            ['password', 'string', 'min' => 4, 'max' => 100, 'tooShort' => \Yii::t('admin', 'Пароль должен быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'Пароль должен быть от 4 до 100 символов')],
            ['password', 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => \Yii::t('admin', 'Логин'),
            'password' => \Yii::t('admin', 'Пароль')
        ];
    }

    public function validateLogin() {
        if (!$this->hasErrors('login')) {
            if (!$this->_administrator = Administrator::findOne(['login' => $this->login])) {
                $this->addError('login', \Yii::t('admin', 'Пользователь не найден'));
            }
        }
    }

    public function validatePassword() {
        if (!$this->hasErrors() && $this->_administrator) {
            if (!\Yii::$app->security->validatePassword($this->password, $this->_administrator->password)) {
                $this->addError('password', \Yii::t('admin', 'Неверный пароль'));
            }
        }
    }

    public function getAdministrator() {
        return $this->_administrator;
    }
}