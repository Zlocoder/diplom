<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\app\assets\AppAsset::register($this);

$this->beginPage();

$this->registerMetaTag(['name' => 'charset', 'content' => Yii::$app->charset]);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
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

    <?php \yii\widgets\Pjax::begin([
        'linkSelector' => '.navbar a, a.pjax',
        'formSelector' => 'form.pjax',
    ]) ?>

        <?= $this->render('/chunks/header'); ?>

        <div class="container">
            <?= $content ?>

        </div>

        <?= $this->render('/chunks/footer'); ?>

    <?php \yii\widgets\Pjax::end() ?>

    <?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>
