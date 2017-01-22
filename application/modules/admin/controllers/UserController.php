<?php

namespace app\admin\controllers;

use app\models\User;
use \yii\db\QueryBuilder;

class UserController extends BaseController {
    public function actionDefault() {
        $this->saveReturnUrl();

        $filterModel = new \app\admin\models\forms\UsersFilter();

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'filterModel' => $filterModel
        ]);
    }

    public function actionCreate() {
        $formModel = new \app\admin\models\forms\UserCreate();

        if (\Yii::$app->request->isPost) {
            $formModel->load(\Yii::$app->request->post());
            $formModel->photo = \yii\web\UploadedFile::getInstance($formModel, 'photo');

            if ($formModel->validate()) {
                if ($formModel->createUser()) {
                    return $this->goBack(['default']);
                } else {
                    throw new \yii\db\Exception('User creating error');
                }
            }
        }

        return $this->render('create', [
            'formModel' => $formModel
        ]);
    }

    public function actionView($id) {
        $this->saveReturnUrl();

        $user = User::findOne($id);

        return $this->render('details', [
            'user' => $user
        ]);
    }

    public function actionUpdate($id) {
        $formModel = new \app\admin\models\forms\UserUpdate(['user' => User::findOne($id)]);

        if (\Yii::$app->request->isPost) {
            $formModel->load(\Yii::$app->request->post());

            if ($formModel->validate()) {
                $formModel->photo = \yii\web\UploadedFile::getInstance($formModel, 'photo');

                if ($formModel->updateUser()) {
                    return $this->goBack(['default']);
                } else {
                    throw new \yii\db\Exception('User updating error');
                }
            }
        }

        return $this->render('update', [
            'formModel' => $formModel
        ]);
    }

    public function actionDelete($id) {
        if ($user = User::findOne($id)) {
            $user->delete();
        }

        return $this->goBack(['default']);
    }
}