<?php

namespace app\admin\models;

use yii;
use yii\base\Model;

use app\models\User;

class UserEditForm extends Model {
    private $_user;

    public $avatar;
    public $login;
    public $email;
    public $changePassword;
    public $password;

    public function rules() {
        return [
            [['id', 'login', 'email'], 'required'],
            [['id'], 'number'],
            [['login', 'email', 'password'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['avatar'], 'image', 'mimeTypes' => 'image/png, image/jpg, image/jpeg', 'maxSize' => 524288],
            [['login', 'email'], 'unique', 'targetClass' => User::className(), 'filter' => ['!=', 'id', $this->id]],
            [['id'], 'exist', 'targetClass' => User::className()],
            [['changePassword'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'avatar' => 'Аватар',
            'login' => 'Логин',
            'email' => 'Email',
            'changePassword' => 'Изменить пароль',
            'password' => 'Пароль'
        ];
    }

    public function setId($value) {
        $this->_user = User::findOne($value);

        if (!$this->_user) {
            throw new yii\base\InvalidValueException("User with `id` $value not found");
        }

        $this->login = $this->_user->login;
        $this->email = $this->_user->email;
    }

    public function getId() {
        if ($this->_user) {
            return $this->_user->id;
        }

        return null;
    }

    public function getAvatarUrl() {
        if ($this->_user) {
            return $this->_user->avatarUrl;
        }

        return null;
    }

    public function update() {
        if ($this->validate()) {
            $this->_user->login = $this->login;
            $this->_user->email = $this->email;

            if ($this->password) {
                $this->_user->password = Yii::$app->security->generatePasswordHash($this->password);
            }

            if ($this->avatar) {
                $this->_user->createAvatar($this->avatar);
            }

            if ($this->_user->save()) {
                return true;
            } else {
                throw new yii\web\ServerErrorHttpException('User updating error');
            }
        }

        return false;
    }
}