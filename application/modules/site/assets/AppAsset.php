<?php

namespace app\site\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web/assets';
    public $css = [
        'css/main.css'
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
