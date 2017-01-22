<?php

namespace app\widgets;

class Pjax extends \yii\widgets\Pjax {
    public function run()
    {
        if (!$this->requiresPjax()) {
            echo \yii\helpers\Html::endTag(\yii\helpers\ArrayHelper::remove($this->options, 'tag', 'div'));
            $this->registerClientScript();

            return;
        }

        $view = $this->getView();
        $view->endBody();

        // Do not re-send css files as it may override the css files that were loaded after them.
        // This is a temporary fix for https://github.com/yiisoft/yii2/issues/2310
        // It should be removed once pjax supports loading only missing css files
        //$view->cssFiles = null;

        $view->endPage(true);

        $content = ob_get_clean();

        // only need the content enclosed within this widget
        $response = \Yii::$app->getResponse();
        $response->clearOutputBuffers();
        $response->setStatusCode(200);
        $response->format = \yii\web\Response::FORMAT_HTML;
        $response->content = $content;
        $response->send();

        \Yii::$app->end();
    }

}