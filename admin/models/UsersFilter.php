<?php

namespace app\admin\models;

use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UsersFilter extends Model {
    public $login;
    public $email;
    public $date_from;
    public $date_to;

    public function rules() {
        return [
            [['login', 'email'], 'string', 'max' => 100, 'tooLong' => '{attribute} не может быть более 100 символов'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Некорректная дата'],
            [['date_from'], function() {
                if ($this->date_to && $this->date_from > $this->date_to) {
                    $this->addError('date_from', 'Неверный диапазон дат');
                    return;
                }

                if ($this->date_from > date('Y-m-d')) {
                    $this->addError('date_from', 'Начало диапазона дат превышает текущую');
                }
            }],
            [['date_to'], function() {
                if ($this->date_from > date('Y-m-d')) {
                    $this->addError('date_to', 'Начало диапазона дат превышает текущую');
                }
            }],
        ];
    }

    public function getProvider() {
        $query = User::find();

        $this->validate();
        if (!$this->hasErrors('login')) {
            $query->andFilterWhere(['like', 'login', $this->login]);
        }

        if (!$this->hasErrors('email')) {
            $query->andFilterWhere(['like', 'email', $this->email]);
        }

        if (!$this->hasErrors('date_from') && !$this->hasErrors('date_to')) {
            $query->andFilterWhere(['>=', 'date_add', $this->date_from]);
            $query->andFilterWhere(['<=', 'date_add', $this->date_to . '23:59:59']);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date_add' => SORT_DESC,
                    'login' => SORT_ASC
                ]
            ],
            'pagination' => [
                'pageSize' => 3
            ]
        ]);
    }
}