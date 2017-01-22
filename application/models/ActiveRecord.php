<?php

namespace app\models;

abstract class ActiveRecord extends \yii\db\ActiveRecord {
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => new \yii\db\Expression('NOW()')
            ]
        ];
    }

    public function rules() {
        return [
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'created_at' => \Yii::t('app', 'Дата создания'),
            'updated_at' => \Yii::t('app', 'Дата изменения')
        ];
    }
}