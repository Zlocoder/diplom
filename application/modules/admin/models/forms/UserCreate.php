<?php

namespace app\admin\models\forms;

use app\models\User;

class UserCreate extends \yii\base\Model {
    public $photo;
    public $login;
    public $password;
    public $fullname;
    public $email;

    public function rules() {
        return [
            ['photo', 'image', 'maxFiles' => 1, 'maxSize' => 2097152, 'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png', 'image/bmp'], 'message' => \Yii::t('admin', 'Ошибка загрузки файла'), 'tooBig' => \Yii::t('admin', 'Размер файла должен быть не более 2 Mb'), 'wrongMimeType' => \Yii::t('admin', 'Непотдерживаемый формат файла')],
            ['login', 'required', 'message' => \Yii::t('admin', 'Введите логин')],
            ['login', 'string', 'min' => 4, 'max' => 100, 'tooShort' => \Yii::t('admin', 'Логин долен быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'Логин долен быть от 4 до 100 символов')],
            ['login', 'unique', 'targetClass' => 'app\models\User', 'message' => \Yii::t('admin', 'Такой пользователь уже существует')],
            ['password', 'required', 'message' => \Yii::t('admin', 'Введите пароль')],
            ['password', 'string', 'min' => 4, 'max' => '100', 'tooShort' => \Yii::t('admin', 'Пароль долен быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'Пароль долен быть от 4 до 100 символов')],
            ['fullname', 'required', 'message' => \Yii::t('admin', 'Введите ФИО')],
            ['fullname', 'string', 'min' => 4, 'max' => 100, 'tooShort' => \Yii::t('admin', 'ФИО должно быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'ФИО должно быть от 4 до 100 символов')],
            ['email', 'required', 'message' => \Yii::t('admin', 'Введите Email')],
            ['email', 'string', 'min' => 4, 'max' => 128, 'tooShort' => \Yii::t('admin', 'Email должен быть от 4 до 128 символов'), 'tooLong' => \Yii::t('admin', 'Email должен быть от 4 до 128 символов')],
            ['email', 'email', 'message' => \Yii::t('admin', 'Некорректный Email')],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => \Yii::t('admin', 'Пользователь с таким Email уже сущестует')]
        ];
    }

    public function attributeLabels() {
        return [
            'photo' => \Yii::t('admin', 'Фото'),
            'login' => \Yii::t('admin', 'Логин'),
            'password' => \Yii::t('admin', 'Пароль'),
            'fullname' => \Yii::t('admin', 'Полное имя'),
            'email' => \Yii::t('admin', 'Email')
        ];
    }

    public function createUser() {
        $user = new User();
        $user->login = $this->login;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->fullname = $this->fullname;
        $user->email = $this->email;
        $user->savePhoto($this->photo);

        return $user->save() ? $user : false;
    }
}