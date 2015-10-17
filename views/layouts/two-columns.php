<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\components\AppAsset;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>

<?
$this->registerMetaTag(['name' => 'charset', 'content' => Yii::$app->charset]);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="main-wrap">
    <?= $this->render('/chunks/header'); ?>

    <?= $this->render('/chunks/main-menu'); ?>

    <div class="content-wrap">
        <div class="content two-columns">
            <?= $this->render('/chunks/filters', ['filter' => $this->params['filter']]); ?>

            <div class="content-in">
                <?= $content ?>
            </div>
        </div>
        <div class="cloud"></div>
    </div>
</div>
</div>

<?= $this->render('/chunks/footer'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
