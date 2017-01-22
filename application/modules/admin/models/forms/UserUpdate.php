<?php

namespace app\admin\models\forms;

use app\models\User;

class UserUpdate extends \yii\base\Model {
    private $_user;

    public $photo;
    public $deletePhoto;
    public $login;
    public $password;
    public $fullname;
    public $email;

    public function rules() {
        return [
            ['photo', 'image', 'maxFiles' => 1, 'maxSize' => 2097152, 'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png', 'image/bmp'], 'message' => \Yii::t('admin', 'Ошибка загрузки файла'), 'tooBig' => \Yii::t('admin', 'Размер файла должен быть не более 2 Mb'), 'wrongMimeType' => \Yii::t('admin', 'Непотдерживаемый формат файла')],
            ['login', 'required', 'message' => \Yii::t('admin', 'Введите логин')],
            ['login', 'string', 'min' => 4, 'max' => 100, 'tooShort' => \Yii::t('admin', 'Логин долен быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'Логин долен быть от 4 до 100 символов')],
            ['login', 'validateLogin'],
            ['password', 'string', 'min' => 4, 'max' => '100', 'tooShort' => \Yii::t('admin', 'Пароль долен быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'Пароль долен быть от 4 до 100 символов')],
            ['fullname', 'required', 'message' => \Yii::t('admin', 'Введите ФИО')],
            ['fullname', 'string', 'min' => 4, 'max' => 100, 'tooShort' => \Yii::t('admin', 'ФИО должно быть от 4 до 100 символов'), 'tooLong' => \Yii::t('admin', 'ФИО должно быть от 4 до 100 символов')],
            ['email', 'required', 'message' => \Yii::t('admin', 'Введите Email')],
            ['email', 'string', 'min' => 4, 'max' => 128, 'tooShort' => \Yii::t('admin', 'Email должен быть от 4 до 128 символов'), 'tooLong' => \Yii::t('admin', 'Email должен быть от 4 до 128 символов')],
            ['email', 'email', 'message' => \Yii::t('admin', 'Некорректный Email')],
            ['email', 'validateEmail'],
            ['deletePhoto', 'safe']
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

    public function setUser($user) {
        if ($user) {
            $this->_user = $user;
            $this->photo = $user->photo;
            $this->login = $user->login;
            $this->fullname = $user->fullname;
            $this->email = $user->email;
        }
    }

    public function getUser() {
        return $this->_user;
    }

    public function getPhotoUrl($size = []) {
        if ($this->_user) {
            return $this->_user->getPhotoUrl($size);
        }

        return User::getDefaultPhotoUrl($size);
    }

    public function getIsPhotoUploaded() {
        return $this->photo && $this->photo instanceof \yii\web\UploadedFile;
    }

    public function updateUser() {
        if ($this->_user) {
            $this->_user->login = $this->login;
            $this->_user->fullname = $this->fullname;
            $this->_user->email = $this->email;

            if ($this->deletePhoto || $this->isPhotoUploaded) {
                $this->_user->deletePhoto();
            }

            if ($this->isPhotoUploaded) {
                $this->_user->savePhoto($this->photo);
            }

            if ($this->password) {
                $this->_user->password = \Yii::$app->security->generatePasswordHash($this->password);
            }

            return $this->_user->save();
        }

        return false;
    }

    public function validateLogin() {
        if ($this->_user && !$this->hasErrors('login') && $this->login != $this->_user->login && User::find()->where(['and', ['login' => $this->login], ['!=', 'id', $this->_user->id]])->one()) {
            $this->addError('login', \Yii::t('admin', 'Логин занят другим пользователем'));
        }
    }

    public function validateEmail() {
        if ($this->_user && !$this->hasErrors('email') && $this->email != $this->_user->email && User::find()->where(['and', ['email' => $this->email], ['!=', 'id', $this->_user->id]])->one()) {
            $this->addError('email', \Yii::t('admin', 'Email занят другим пользователем'));
        }
    }
}