<?php
namespace app\admin;

use yii;
use yii\base\Module;

class AdminModule extends Module {
    public $defaultRoute = 'admin/index';

    public function init() {
        parent::init();

        Yii::configure($this, require 'config.php');
    }
}