<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\imagine\Image;

use Imagine\Exception\InvalidArgumentException;

class User extends ActiveRecord implements IdentityInterface {
    public static function tableName() {
        return 'user';
    }

    public function rules() {
        return [
            [['login', 'email', 'password'], 'required'],
            [['login', 'email', 'password'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['login', 'email'], 'unique'],
            [['avatar'], 'string', 'max' => 16],
            [['avatar'], function () {
                if (!file_exists(User::avatarPath() . '/' . $this->avatar . '.png')) {
                    $this->addError('avatar', 'file not exists');
                }
            }],
            [['date_add'], 'default', 'value' => function () {return date('Y-m-d H:i:s'); }],
            [['date_add'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss']
        ];
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public function getId() {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null) {}

    public function getAuthKey() {}

    public function validateAuthKey($authKey) {}

    public static function getAvatarSizes() {
        return [
            [50, 50],
            [100, 100]
        ];
    }

    public static function avatarPath() {
        return Yii::getAlias('@webroot/images/avatars');
    }

    public function createAvatar($uploadedAvatar) {
        $fileName = $this->avatar ? $this->avatar : Yii::$app->security->generateRandomString(16);

        $uploadedAvatar->saveAs(User::avatarPath() . '/' . $fileName);

        foreach (User::getAvatarSizes() as $size) {
            Image::thumbnail(User::avatarPath() . '/' . $fileName, $size[0], $size[1])->save(User::avatarPath() . "/{$fileName}_{$size[0]}_{$size[1]}.png");
        }

        Image::getImagine()->open(User::avatarPath() . '/' . $fileName)->save(User::avatarPath() . '/' . $fileName . '.png');
        unlink(User::avatarPath() . '/' . $fileName);

        $this->avatar = $fileName;
    }

    public function getAvatarUrl($size = []) {
        if (empty($size)) {
            if (!file_exists(User::avatarPath() . '/' . $this->avatar . '.png')) {
                return Yii::getAlias("@web/images/avatars/default.png");
            }

            return Yii::getAlias("@web/images/avatars/{$this->avatar}.png");
        } else {
            if (!in_array($size, User::getAvatarSizes())) {
                throw new InvalidArgumentException('Wrong size');
            }

            if (!file_exists(User::avatarPath() . "/{$this->avatar}_{$size[0]}_{$size[1]}.png")) {
                return Yii::getAlias("@web/images/avatars/default.png");
            }

            return Yii::getAlias("@web/images/avatars/{$this->avatar}_{$size[0]}_{$size[1]}.png");
        }
    }

    public function attributeLabels() {
        return [
            'avatar' => 'Аватар',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'date_add' => 'Дата регистрации'
        ];
    }
}