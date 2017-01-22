<?php

namespace app\admin\models\forms;

class UsersFilter extends \yii\base\Model {
    public $id;
    public $login;
    public $fullname;
    public $email;
    public $created_at;
    public $updated_at;

    public function rules() {
        return [
            ['id', 'number', 'message' => \Yii::t('admin', 'введите число')],
            [['login', 'fullname'], 'string', 'max' => 100, 'tooLong' => 'максимум 100 символов'],
            ['email', 'string', 'max' => 128, 'tooLong' => 'максимум 128 символов'],
            [['created_at', 'updated_at'], 'validateDateRange'],
        ];
    }

    public function validateDateRange() {

    }
}