<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<header>
    <div class="container">
        <a href="<?= Url::to(['site/index']); ?>" class="logo" title="FL step"></a>

        <ul>
            <li>
                <a href="">Работа <i class="fa fa-caret-down"></i></a>

                <ul>
                    <li><a href="">Вакансии</a></li>
                    <li><a href="">Заказы</a></li>
                    <li><a href="">Конкурсы</a></li>
                </ul>
            </li>

            <li>
                <a href="">Фрилансеры <i class="fa fa-caret-down"></i></a>

                <ul>
                    <li><a href="">Исполнители</a></li>
                    <li><a href="">Работы</a></li>
                    <li><a href="">Резюме</a></li>
                </ul>
            </li>
        </ul>

        <div class="userbar">
            <?php if (Yii::$app->user->isGuest) { ?>
                <?php
                $form = ActiveForm::begin([
                    'action' => ['auth/login'],
                    'method' => 'post',
                    'enableClientValidation' => false,
                    'fieldConfig' => [
                        'template' => '{input}'
                    ]
                ]);

                $inlineLoginForm = new app\models\InlineLoginForm();

                echo $form->field($inlineLoginForm, 'login')->textInput(['placeholder' => $inlineLoginForm->getAttributeLabel('login')]);
                echo $form->field($inlineLoginForm, 'password')->passwordInput(['placeholder' => $inlineLoginForm->getAttributeLabel('password')]);
                ?>

                <button type="submit">Войти</button>

                <?php ActiveForm::end(); ?>

                <span>или</span>

                <a class="button" href="<?= Url::to(['auth/registration']) ?>">Зарегистрироваться</a>
            <?php } else { ?>
                <ul>
                    <li><a href=""><i class="big fa fa-envelope"><span>3</span></i></a></li>

                    <li><a href=""><i class="big fa fa-info"><span>3</span></i></a></li>

                    <li><a href=""><i class="big fa fa-usd"></i> 3.00</a></li>

                    <li>
                        <a href="" class="user"><i class="big fa fa-user"></i> <?= Yii::$app->user->identity->login ?> <i class="fa fa-caret-down"></i></a>
                        <ul>
                            <li><a href="">Кабинет</a></li>
                            <li><a href="">Профиль</a></li>
                            <li><a href="">Портфолио</a></li>
                            <li><a href="">Резюме</a></li>
                        </ul>
                    </li>

                    <li><a href="<?= Url::to(['auth/logout']) ?>">Выйти</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</header>