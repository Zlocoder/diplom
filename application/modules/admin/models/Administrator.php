<?php

namespace app\admin\models;

class Administrator extends \app\models\ActiveRecord implements \yii\web\IdentityInterface {
    public static function tableName() {
        return 'admin_user';
    }

    public function rules() {
        return \yii\helpers\ArrayHelper::merge(parent::rules(), [
            [['login', 'password', 'created_at', 'updated_at'], 'required'],
            [['login', 'password'], 'string', 'max' => '128'],
            [['login'], 'unique']
        ]);
    }

    public function attributeLabels()
    {
        return \yii\helpers\ArrayHelper::merge(parent::attributeLabels(), [
            'login' => \Yii::t('admin', 'Логин'),
            'password' => \Yii::t('admin', 'Пароль'),
            'fullname' => \Yii::t('admin', 'Полное имя'),
            'email' => \Yii::t('admin', 'Email'),
        ]);
    }

    public static function findIdentity($id)
    {
        return Administrator::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey() {}

    public function validateAuthKey($authKey) {}

    public static function findIdentityByAccessToken($token, $type = null) {}
}