<?php

namespace app\models\forms;

use Yii;

class RegistrationForm extends \yii\base\Model {
    public $login;
    public $password;
    public $email;
    public $confirm;
    public $photo;

    public function rules() {
        return [
            ['login', 'required', 'message' => Yii::t('app', 'Введите логин')],
            ['email', 'required', 'message' => Yii::t('app', 'Введите email')],
            ['password', 'required', 'message' => Yii::t('app', 'Введите пароль')],
            ['confirm', 'required', 'message' => Yii::t('app', 'Подтвердите пароль')],
            ['confirm', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Пароли не совпадают')],
            [['login', 'email', 'password', 'confirm'], 'string', 'max' => 100, 'tooLong' => Yii::t('app', 'Значение не может быть более 100 символов')],
            ['login', 'match', 'pattern' => '/^[[:alnum:]]+[ [:alnum:]]*[^ ]$/', 'message' => Yii::t('app', 'Логин может содержать только буквы цифры и пробелы. Не должен начинаться и заканчиваться пробелом.')],
            ['email', 'email', 'message' => Yii::t('app', 'Некоректный email')],
            ['photo', 'image', 'mimeTypes' => 'image/png, image/bmp, image/jpg, image/jpeg', 'maxSize' => 2097152, 'wrongMimeType' => Yii::t('app', 'Неверный формат файла'), 'tooBig' => Yii::t('app', 'Файл не должен превышать 2 Мб')],
            ['login', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app', 'Пользователь с таким логином уже существует')],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app', 'Пользователь с таким email уже существует')],
        ];
    }

    public function attributeLabels() {
        return [
            'login' => Yii::t('app', 'Логин'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Пароль'),
            'confirm' => Yii::t('app', 'Подтверждение пароля'),
            'photo' => Yii::t('app', 'Фото'),
        ];
    }

    public function registerUser() {
        return new \app\models\User();
    }
}