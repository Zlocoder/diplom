<?php

namespace app\models;

use yii;
use yii\base\Model;

class UserRegistrationForm extends Model {
    public $avatar;
    public $login;
    public $email;
    public $password;
    public $confirm;

    public function rules() {
        return [
            [['login', 'email', 'password', 'confirm'], 'required', 'message' => 'Введите {attribute}'],
            [['login', 'email', 'password', 'confirm'], 'string', 'max' => 100, 'tooLong' => '{attribute} не может быть более 100 символов'],
            [['email'], 'email', 'message' => 'Некорректный Email'],
            [['avatar'], 'image', 'mimeTypes' => 'image/jpg, image/png, image/jpeg, image/bmp', 'notImage' => 'Файл должен быть картинкой', 'wrongMimeType' => 'Изображение должно быть в формате: png/jpg/bmp ', 'maxSize' => 524288, 'tooBig' => 'Файл должен быть не более 500кБ'],
            [['confirm'], 'compare', 'compareAttribute' => 'password'],
            [['login', 'email'], 'unique', 'targetClass' => User::className(), 'message' => 'Этот {attribute} уже занят']
        ];
    }

    public function attributeLabels() {
        return [
            'avatar' => 'Аватар',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'confirm' => 'Подтверждение пароля'
        ];
    }

    public function registrate() {
        if ($this->validate()) {
            $user = new User();
            $user->login = $this->login;
            $user->email = $this->email;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);

            if ($this->avatar) {
                $user->createAvatar($this->avatar);
            }

            if ($user->save()) {
                return $user;
            } else {
                throw new yii\web\ServerErrorHttpException('User creating error');
            }
        }

        return null;
    }
}