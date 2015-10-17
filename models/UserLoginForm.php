<?php

namespace app\models;

use app\models\User;
use yii;
use yii\base\Model;

class UserLoginForm extends Model {
    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required', 'message' => 'Введите {attribute}'],
            [['login', 'password'], 'string', 'max' => 100, 'tooLong' => '{attribute} не может быть более 100 символов'],
            [['login'], 'exist', 'targetClass' => User::className(), 'message' => '{attribute} не найден'],
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }

    public function login() {
        if ($this->validate()) {
            $user = User::findOne(['login' => $this->login]);
            if (Yii::$app->security->validatePassword($this->password, $user->password)) {
                return $user;
            }

            $this->addError('form', 'Неверный логин или пароль');
        }

        return null;
    }
}