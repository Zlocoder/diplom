<?php
/* @var $this yii\web\View */
/* @var $model yii\base\Model */

use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\ActiveField;
use yii\helpers\Html;
?>

<?= \yii\widgets\Breadcrumbs::widget([
    'homeLink' => ['label' => 'Панель управления', 'url' => ['admin/index']],
    'links' => [
        ['label' => 'Пользователи', 'url' => ['index']]
    ]
]) ?>

<div class="panel panel-default">
    <div class="panel-heading">Создание пользователя</div>

    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]);

        echo $form->field($model, 'avatar')->fileInput();

        echo $form->field($model, 'login');

        echo $form->field($model, 'email');

        echo $form->field($model, 'password', ['template' => '{label} {beginWrapper} <button type="button" id="generatePassword" class="btn btn-default pull-right">Сгенерировать</button> {input}  {error} {endWrapper} {hint}', 'inputOptions' => ['style' => 'width: 70%']]);
        ?>

        <div class="form-group">
            <div class="col-sm-3"></div>

            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
            </div>
        </div>

        <?php $form->end(); ?>
    </div>
</div>
