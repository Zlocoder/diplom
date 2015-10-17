<?php

use yii\widgets\ActiveForm;

?>

<h1>Создание конкурса</h1>

<?php
$form = ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'class' => 'fullsize-form',
        'enctype' => 'multipart/form-data'
    ],
    'fieldConfig' => [
        'options' => [
            'class' => 'field'
        ]
    ]
]);

?>
<div class="clear">
    <?= $form->field($model, 'poster', ['options' => ['class' => 'field image-left']])->fileInput(); ?>

    <?= $form->field($model, 'title', ['options' => ['class' => 'field big-text', 'style' => 'margin-left: 230px;']]); ?>
</div>

<?= $form->field($model, 'description')->textarea(); ?>

<div class="field">
    <button type="submit" class="btn accented submit">Создать</button>
</div>

<?php ActiveForm::end() ?>