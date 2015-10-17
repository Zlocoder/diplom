<?php

namespace app\admin\controllers;

class AdminController extends BaseController {
    public function actionIndex() {
        return $this->render('/index');
    }
}