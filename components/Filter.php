<?php

namespace app\components;

use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\helpers\Html;

class Filter extends Widget {
    public $model;

    public function init() {
        if (!isset($this->model)) {
            throw new InvalidParamException('model not exists');
        }

        if (!is_a($this->model, 'app\components\FilterInterface')) {
            throw new InvalidParamException('model must implement FilterInterface');
        }
    }


    public function run() {
        $output = '';
        foreach ($this->model->filterBlocks as $block) {
            $output .= Html::beginTag('div', ['class' => 'block']);
            $output .= Html::beginTag('div', ['class' => 'block-in']);
            foreach($block['items'] as $type => $field) {
                $output .= Html::beginTag('div', ['class' => 'field']);
                switch ($type) {
                    case 'link' : $output .= Html::a($field['text'], $field['url'], $field['options']); break;
                }
                $output .= Html::endTag('div');
            }
            $output .= Html::endTag('div');
            $output .= Html::endTag('div');
        }

        return $output;
    }
}