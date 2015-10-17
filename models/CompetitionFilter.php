<?php

namespace app\models;

use yii\base\Model;

use app\components\FilterInterface;

class CompetitionFilter extends Model implements FilterInterface {
    public function rules() {
        return [

        ];
    }

    public function attribuetLabels() {
        return [

        ];
    }

    public function getFilterBlocks() {
        return [
            [
                'items' => [
                    'link' => [
                        'text' => 'Создать конкурс',
                        'url' => ['competition/create'],
                        'options' => [
                            'class' => 'btn accented'
                        ]
                    ]
                ]
            ]
        ];
    }
}