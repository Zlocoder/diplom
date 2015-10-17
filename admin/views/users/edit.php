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
    <div class="panel-heading">Редактирование пользователя</div>

    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]);

        echo $form->field($model, 'id', ['options' => ['class' => 'hidden']])->hiddenInput();

        echo $form->field($model, 'avatar')->fileInput();

        if ($model->avatarUrl) {
            ?>
                <div class="form-group">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        <img src="<?= $model->avatarUrl ?>" style="max-height: 300px; max-width: 300px;"/>
                    </div>
                </div>
            <?php
        }

        echo $form->field($model, 'login');

        echo $form->field($model, 'email');

        echo $form->field($model, 'changePassword')->checkbox(['id' => 'changePassword']);

        echo $form->field($model, 'password', ['template' => '{label} {beginWrapper} {input} <button type="button" id="generatePassword" class="btn btn-default pull-right">Сгенерировать</button> {error} {endWrapper} {hint}', 'inputOptions' => ['style' => 'width: 70%; float: left;'], 'options' => ['id' => 'passwordField', 'class' => 'form-group']]);
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