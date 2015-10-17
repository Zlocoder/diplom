<?php

namespace app\admin\models;

use yii;
use yii\base\Model;

use app\models\User;

class UserCreateForm extends Model {
    public $avatar;
    public $login;
    public $email;
    public $password;

    public function rules() {
        return [
            [['login', 'email', 'password'], 'required'],
            [['login', 'email', 'password'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['avatar'], 'image', 'mimeTypes' => 'image/png, image/jpg, image/jpeg', 'maxSize' => 524288],
            [['login', 'email'], 'unique', 'targetClass' => User::className()]
        ];
    }

    public function attributeLabels() {
        return [
            'avatar' => 'Аватар',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    public function create() {
        if ($this->validate()) {
            $user = new User();
            $user->login = $this->login;
            $user->email = $this->email;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);

            if ($this->avatar) {
                $user->createAvatar($this->avatar);
            }

            if ($user->save()) {
                return true;
            } else {
                throw new yii\web\ServerErrorHttpException('User creating error');
            }
        }

        return false;
    }
}