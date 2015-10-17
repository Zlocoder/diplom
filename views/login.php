<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';

$form = ActiveForm::begin([
    'method' => 'post'
]);

echo $form->field($model, 'login');

echo $form->field($model, 'password')->passwordInput();

?>

<div class="form-control">
    <button type="submit">Войти</button>
</div>

<?php ActiveForm::end(); ?>


