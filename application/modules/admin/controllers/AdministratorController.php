<?php

namespace app\admin\controllers;

use app\admin\models\Administrator;

class AdministratorController extends BaseController {
    public function actionDefault() {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Administrator::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id) {
        $administrator = Administrator::findOne($id);
        return $this->render('details', [
            'administrator' => $administrator
        ]);
    }

    public function actionUpdate($id) {
        return 'edit ' . $id;
    }

    public function actionDelete($id) {
        return 'delete' . $id;
    }
}