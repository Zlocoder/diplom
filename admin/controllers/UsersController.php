<?php

namespace app\admin\controllers;

use yii;
use yii\web\UploadedFile;

use app\models\User;
use app\admin\models\UsersFilter;
use app\admin\models\UserCreateForm;
use app\admin\models\UserEditForm;

class UsersController extends BaseController {
    public function actionIndex() {
        $usersFilter = new UsersFilter();
        $usersFilter->load(Yii::$app->request->get());

        return $this->render('list', ['filter' => $usersFilter]);
    }

    public function actionCreate() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->get('generatePassword')) {
                //Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
                return Yii::$app->security->generateRandomString(8);
            }
        } else {
            $userCreateForm = new UserCreateForm();

            if (Yii::$app->request->isPost) {
                $userCreateForm->load(Yii::$app->request->post());
                $userCreateForm->avatar = UploadedFile::getInstance($userCreateForm, 'avatar');

                if ($userCreateForm->create()) {
                    $this->redirect(['index']);
                }
            }

            return $this->render('create', ['model' => $userCreateForm]);
        }
    }

    public function actionUpdate($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->get('generatePassword')) {
                //Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
                return Yii::$app->security->generateRandomString(8);
            }
        } else {
            if (Yii::$app->request->isPost) {
                $userEditForm = new UserEditForm(Yii::$app->request->post('UserEditForm'));
                $userEditForm->avatar = UploadedFile::getInstance($userEditForm, 'avatar');

                if ($userEditForm->update()) {
                    $this->redirect(['index']);
                }
            } else {
                $userEditForm = new UserEditForm(['id' => $id]);
            }

            return $this->render('edit', ['model' => $userEditForm]);
        }
    }
}