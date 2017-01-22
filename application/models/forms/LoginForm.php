<?php
namespace app\models\forms;

use yii;

class LoginForm extends \yii\base\Model {
    public $login;
    public $password;

    public function rules() {
        return [
            ['login', 'required', 'message' => Yii::t('app', 'Введите логин')],
            ['password', 'required', 'message' => Yii::t('app', 'Введите пароль')],
            ['login', 'string', 'max' => 100, 'tooLong' => Yii::t('app', 'Логин не может быть более 100 символов.')],
            ['password', 'string', 'max' => 100, 'tooLong' => Yii::t('app', 'Логин не может быть более 100 символов.')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль')
        ];
    }

    public function login() {
    }
}