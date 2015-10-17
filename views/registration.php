<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Регистрация';

$form = ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]);

echo $form->field($model, 'avatar')->fileInput();

echo $form->field($model, 'login');

echo $form->field($model, 'email');

echo $form->field($model, 'password')->passwordInput();

echo $form->field($model, 'confirm')->passwordInput();

?>

<div class="form-control">
    <button type="submit">Зарегистрироваться</button>
</div>

<?php ActiveForm::end(); ?>


