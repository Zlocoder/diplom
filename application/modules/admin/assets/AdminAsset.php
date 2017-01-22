<?php

namespace app\admin\assets;

class AdminAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@admin/views/assets';

    public $css = [
        'admin.css'
    ];

    public $js = [
        'admin.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
