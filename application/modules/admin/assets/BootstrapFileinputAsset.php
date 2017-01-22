<?php

namespace app\admin\assets;

class BootstrapFileinputAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/kartik-v/bootstrap-fileinput';

    public $css = [
        'css/fileinput.css'
    ];

    public $js = [
        'js/fileinput.js'
    ];
}
