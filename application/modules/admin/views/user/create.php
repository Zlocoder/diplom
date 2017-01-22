<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-content',
    'linkSelector' => 'a[data-pjax=pjax-content]',
    'formSelector' => 'form[data-pjax=pjax-content]',
    'timeout' => 30000
]) ?>

<?php $this->title = \Yii::t('admin', 'Пользователи') ?>

<?= $this->render('/chunks/breadcrumbs', [
    'links' => [
        [
            'label' => Yii::t('admin', 'Пользователи'),
            'url' => \yii\helpers\Url::to(['user/default']),
            'data-pjax' => 'pjax-content'
        ]
    ]
]) ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'method' => 'post',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}"
            ],
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-pjax' => 'pjax-content'
            ]
        ]) ?>

            <div class="panel panel-default">
                <div class="panel-heading"><?= \Yii::t('admin', 'Новый пользователя') ?></div>

                <div class="panel-body">
                    <?= $form->field($formModel, 'photo')->widget('kartik\file\FileInput', [
                        'options' => [
                            'accept' => 'image/jpeg, image/jpg, image/png, image/bmp'
                        ],
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-default btn-block'
                        ]
                    ]) ?>

                    <?= $form->field($formModel, 'login') ?>

                    <?= $form->field($formModel, 'password', [
                        'template' => "{label}\n{input}\n{error}\n" . '<p><button class="btn btn-default btn-block generate-password" type="button">' . \Yii::t('admin', 'Сгенерировать пароль') . '</button></p>',
                        'inputOptions' => [
                            'class' => 'form-control password'
                        ]
                    ]) ?>

                    <?= $form->field($formModel, 'fullname') ?>

                    <?= $form->field($formModel, 'email') ?>
                </div>

                <div class="panel-footer clearfix">
                    <div class="pull-right">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                        <button class="btn btn-default" type="button">
                            <a href="<?= \yii\helpers\Url::to(['user/default']) ?>" data-pjax="pjax-content">Отмена</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php \yii\bootstrap\ActiveForm::end() ?>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
