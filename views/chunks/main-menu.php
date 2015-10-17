<?php
use yii\helpers\Url;
?>
<nav>
    <a class="logo" href="<?= Yii::$app->urlManager->baseUrl ?>"><img src="images/logo.png" alt=""></a>

    <a class="main_option" href="<?= Url::to(['competition/index']) ?>">Конкурсы</a>

    <?php if (Yii::$app->user->isGuest) { ?>
        <a class="main_option" href="<?= Url::to(['auth/login']) ?>">Вход</a>
        <a class="main_option" href="<?= Url::to(['auth/registration']) ?>">Регистрация</a>
    <?php } else { ?>
        <a class="main_option" href="<?= Url::to(['auth/logout']) ?>">Выйти</a>
    <?php } ?>
</nav>