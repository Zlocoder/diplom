<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

app\admin\assets\AdminAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php $modal = \app\widgets\ModalForm::begin([
    'header' => '<h4>' . \Yii::$app->name . '<br/><br/><b>' . \Yii::t('admin', 'Вход в панель управления') . '</b></h4>',
    'footer' => '<button type="submit" class="btn btn-primary">Войти</button>',
    'clientOptions' => [
        'show' => true
    ],
    'formOptions' => [
        'method' => 'post',
        'enableAjaxValidation' => true
    ],
    'closeButton' => false,
    'size' => \app\widgets\ModalForm::SIZE_SMALL
]) ?>

<?= $modal->form->field($loginForm, 'login') ?>

<?= $modal->form->field($loginForm, 'password')->passwordInput() ?>

<?php $modal::end(); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
