<?php

namespace app\models;

class User extends ActiveRecord implements \yii\web\IdentityInterface {
    public static function tableName() {
        return 'user';
    }

    public function rules() {
        return \yii\helpers\ArrayHelper::merge(parent::rules(), [
            [['login', 'password', 'fullname', 'email'], 'required'],
            [['login', 'password', 'fullname'], 'string', 'max' => 100],
            ['email', 'string', 'max' => 128],
            ['email', 'email'],
            ['photo', 'string', 'min' => 32, 'max' => 32],
            ['photo', 'validatePhoto'],
        ]);
    }

    public function attributeLabels() {
        return \yii\helpers\ArrayHelper::merge(parent::attributeLabels(), [
            'photo' => \Yii::t('app', 'Фото'),
            'login' => \Yii::t('app', 'Логин'),
            'password' => \Yii::t('app', 'Пароль'),
            'fullname' => \Yii::t('app', 'Полное имя'),
            'email' => \Yii::t('app', 'Email'),
        ]);
    }

    public function validatePhoto() {
        if ($this->photo && !$this->hasErrors('photo') && !file_exists(self::getPhotoPath() . "/{$this->photo}.png")) {
            $this->addError('photo', 'File not exists');
        }
    }

    public static function getPhotoSizes() {
        return [
            [50,50],
            [100,100]
        ];
    }

    public static function getPhotoPath() {
        return \Yii::getAlias('@webroot/uploads/users');
    }

    public function getHasPhoto() {
        return !empty($this->photo);
    }

    public function getPhotoUrl($size = []) {
        if ($this->hasPhoto) {
            if (!empty($size)) {
                return \Yii::getAlias('@web/uploads/users') . "/{$this->photo}_{$size[0]}_{$size[1]}.png";
            }

            return \Yii::getAlias('@web/uploads/users') . "/{$this->photo}.png";
        } else {
            return self::getDefaultPhotoUrl($size);
        }
    }

    public static function getDefaultPhotoUrl($size = []) {
        if (!empty($size)) {
            return \Yii::getAlias('@web/uploads/users') . "/default_{$size[0]}_{$size[1]}.png";
        } else {
            return \Yii::getAlias('@web/uploads/users') . "/default.png";
        }
    }

    public function savePhoto($uploadedPhoto) {
        if ($uploadedPhoto && !$uploadedPhoto->hasError) {
            $fileName = \Yii::$app->security->generateRandomString();
            \yii\imagine\Image::getImagine()->open($uploadedPhoto->tempName)->save(self::getPhotoPath() . "/{$fileName}.png");
            foreach (self::getPhotoSizes() as $size) {
                \yii\imagine\Image::getImagine()
                    ->open(self::getPhotoPath() . "/{$fileName}.png")
                    ->thumbnail(new \Imagine\Image\Box($size[0], $size[1]), \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)
                    ->save(self::getPhotoPath() . "/{$fileName}_{$size[0]}_{$size[1]}.png");
            }

            $this->photo = $fileName;
        }
    }

    public function deletePhoto() {
        if ($this->photo) {
            @unlink(self::getPhotoPath() . "/{$this->photo}.png");

            foreach (self::getPhotoSizes() as $size) {
                @unlink(self::getPhotoPath() . "/{$this->photo}_{$size[0]}_{$size[1]}.png");
            }

            $this->photo = '';
        }
    }

    public function delete() {
        $this->deletePhoto();

        return parent::delete();
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
}