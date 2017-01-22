<?php

/* @var $this \yii\web\View */
/* @var $headerLoginForm \app\models\forms\HeaderLoginForm */

use yii\helpers\Url;
?>

<header>
    <?php \yii\bootstrap\NavBar::begin([
        'brandLabel' => '<span>' . Yii::$app->name . '</span>',
        'options' => [
            'class' => 'navbar navbar-fixed-top'
        ]
    ]) ?>

        <?= \yii\bootstrap\Nav::widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'Работа'),
                    'url' => [''],
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Вакансии'),
                            'url' => ['']
                        ],
                        [
                            'label' => Yii::t('app', 'Конкурсы'),
                            'url' => ['']
                        ],
                        [
                            'label' => Yii::t('app', 'Заказы'),
                            'url' => ['']
                        ]
                    ],
                    'linkOptions' => ['class' => 'dropdown-toggle disabled']
                ],
                [
                    'label' => Yii::t('app', 'Фрилансеры'),
                    'url' => [''],
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Исполнители'),
                            'url' => ['']
                        ],
                        [
                            'label' => Yii::t('app', 'Работы'),
                            'url' => ['']
                        ],
                        [
                            'label' => Yii::t('app', 'Резюме Резюме'),
                            'url' => ['']
                        ]
                    ],
                    'linkOptions' => ['class' => 'dropdown-toggle disabled']
                ],
            ],
            'options' => [
                'class' => 'nav navbar-nav'
            ]
        ]) ?>

        <div class="pull-right">
            <?php if (Yii::$app->user->isGuest) { ?>
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#loginModal" href=""><?= Yii::t('app', 'Вход') ?></a>
                <a class="btn btn-primary btn-sm" href=""><?= Yii::t('app', 'Регистрация') ?></a>

                <?php $modal = \app\widgets\ModalForm::begin([
                    'id' => 'loginModal',
                    'header' => '<h4>Вход</h4>',
                    'footer' => '<button type="submit" class="btn btn-primary">Войти</button> <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>',
                    'size' => \yii\bootstrap\Modal::SIZE_SMALL,
                ]) ?>

                    <?php $loginForm = new \app\models\forms\LoginForm(); ?>
                    <?= $modal->form->field($loginForm, 'login') ?>
                    <?= $modal->form->field($loginForm, 'password')->passwordInput() ?>

                <?php \app\widgets\ModalForm::end() ?>
            <?php } else { ?>
            <?php } ?>
        </div>

    <?php \yii\bootstrap\Navbar::end() ?>
</header>