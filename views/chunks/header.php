<?php
use yii\helpers\Url;
?>
<header>
    <?php if (Yii::$app->user->isGuest) { ?>
        <span style="color: #fff;">Привет, гость!</span>
    <?php } else { ?>
        <span style="color: #fff;">Привет, <?= Yii::$app->user->identity->login ?>!</span>
    <?php } ?>
</header>