<?php

namespace app\admin\controllers;

class DashboardController extends BaseController {
    public function actionDefault() {
        return $this->render('/dashboard');
    }
}