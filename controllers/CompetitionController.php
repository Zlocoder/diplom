<?php

namespace app\controllers;

use yii;
use yii\web\Controller;

use app\models\Competition;
use app\models\CompetitionFilter;

class CompetitionController extends Controller {
    public function actionIndex() {
        $this->layout = 'two-columns';

        $filter = new CompetitionFilter(Yii::$app->request->get('CompetitionFilter'));
        $this->view->params['filter'] = $filter;

        return $this->render('/competitions');
    }

    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['index']);
        }
        $competition = new Competition(['scenario' => 'create']);

        if (Yii::$app->request->isPost) {
            $competition->load(Yii::$app->request->post());
            $competition->creator_id = Yii::$app->user->id;
            $competition->create();

            if (!$competition->hasErrors()) {
                $this->redirect(['view', 'id' => $competition->id]);
            }
        }

        return $this->render('/competition-create', ['model' => $competition]);
    }
}