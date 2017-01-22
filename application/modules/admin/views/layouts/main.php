<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

app\admin\assets\AdminAsset::register($this);
use yii\web\View;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>FL Step - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-main',
    'linkSelector' => 'a[data-pjax=pjax-main]',
    'formSelector' => 'form[data-pjax=pjax-main]',
    'timeout' => 30000
]) ?>

<header>
    <?php \yii\bootstrap\NavBar::begin([
        'brandLabel' => 'FL Step',
        'brandUrl' => \yii\helpers\Url::to(['dashboard/default']),
        'brandOptions' => [
            'data-pjax' => 'pjax-main'
        ],
        'options' => [
            'class' => 'navbar navbar-inverse navbar-static-top'
        ]
    ]) ?>

    <?= \yii\bootstrap\Nav::widget([
        'items' => [
            [
                'label' => \Yii::t('admin', 'Пользователи'),
                'items' => [
                    [
                        'label' => \Yii::t('admin', 'Пользователи'),
                        'url' => ['user/default'],
                        'active' => \Yii::$app->controller instanceof \app\admin\controllers\UserController,
                        'linkOptions' => [
                            'data-pjax' => 'pjax-main'
                        ]
                    ],
                    [
                        'label' => \Yii::t('admin', 'Администрация'),
                        'url' => ['administrator/default'],
                        'active' => \Yii::$app->controller instanceof \app\admin\controllers\AdministratorController,
                        'linkOptions' => [
                            'data-pjax' => 'pjax-main'
                        ]
                    ]
                ]
            ]
        ],
        'options' => [
            'class' => 'nav navbar-nav'
        ]
    ]) ?>

    <?php \yii\bootstrap\NavBar::end() ?>
</header>

<div class="container">
    <?= $content ?>
</div>

<?php \yii\widgets\Pjax::end(); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
