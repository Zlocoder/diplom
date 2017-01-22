<?php

namespace app\components;

use yii\helpers\Html;

class View extends \yii\web\View {
    protected function renderBodyEndHtml($ajaxMode)
    {
        $lines = [];

        if (!empty($this->jsFiles[self::POS_END])) {
            $lines[] = implode("\n", $this->jsFiles[self::POS_END]);
        }

        if (\Yii::$app->request->isPjax) {
            $scripts = [];
            if (!empty($this->js[self::POS_END])) {
                $scripts[] = implode("\n", $this->js[self::POS_END]);
            }
            if (!empty($this->js[self::POS_READY])) {
                $scripts[] = implode("\n", $this->js[self::POS_READY]);
            }
            if (!empty($this->js[self::POS_LOAD])) {
                $scripts[] = implode("\n", $this->js[self::POS_LOAD]);
            }
            if (!empty($scripts)) {
                $lines[] = Html::script("setTimeout( function() {\n" . implode("\n", $scripts) . "\n}, 500);", ['type' => 'text/javascript']);
            }
        } elseif (\Yii::$app->request->isAjax) {
            $scripts = [];
            if (!empty($this->js[self::POS_END])) {
                $scripts[] = implode("\n", $this->js[self::POS_END]);
            }
            if (!empty($this->js[self::POS_READY])) {
                $scripts[] = implode("\n", $this->js[self::POS_READY]);
            }
            if (!empty($this->js[self::POS_LOAD])) {
                $scripts[] = implode("\n", $this->js[self::POS_LOAD]);
            }
            if (!empty($scripts)) {
                $lines[] = Html::script(implode("\n", $scripts), ['type' => 'text/javascript']);
            }
        } else {
            if (!empty($this->js[self::POS_END])) {
                $lines[] = Html::script(implode("\n", $this->js[self::POS_END]), ['type' => 'text/javascript']);
            }
            if (!empty($this->js[self::POS_READY])) {
                $js = "jQuery(document).ready(function () {\n" . implode("\n", $this->js[self::POS_READY]) . "\n});";
                $lines[] = Html::script($js, ['type' => 'text/javascript']);
            }
            if (!empty($this->js[self::POS_LOAD])) {
                $js = "jQuery(window).load(function () {\n" . implode("\n", $this->js[self::POS_LOAD]) . "\n});";
                $lines[] = Html::script($js, ['type' => 'text/javascript']);
            }
        }

        return empty($lines) ? '' : implode("\n", $lines);
    }
}