<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
?>

<div class="breadcrumbs">
    <i class="fa fa-angle-double-right"></i>
    <span>Вход</span>
</div>

<div class="center-wrapper">
    <section class="block">
        <h1>Вход</h1>

        <?php
        $form = ActiveForm::begin([
            'method' => 'post',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
            ]
        ]);

        echo $form->field($model, 'login');

        echo $form->field($model, 'password')->passwordInput();
        ?>

        <div class="form-group">
            <button type="submit">Войти</button>
        </div>

        <?php ActiveForm::end(); ?>
    </section>
</div>



