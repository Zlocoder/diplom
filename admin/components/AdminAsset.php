<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\admin\components;

use yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@admin/assets';
    public $css = [
        'bootstrap-datepicker.min.css',
        'site.css'
    ];
    public $js = [
        'bootstrap-datepicker.min.js',
        'main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $forceCopy = true;

    /*
    public function init() {
        $this->sourcePath = Yii::getAlias('@admin/assets');
    }
    */
}
