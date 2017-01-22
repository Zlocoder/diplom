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
        <?php if ($formModel->user) { ?>
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
                <div class="panel-heading"><?= $formModel->fullname ?></div>

                <div class="panel-body">
                    <?= $form->field($formModel, 'photo')->widget('kartik\file\FileInput', [
                        'options' => [
                            'accept' => 'image/jpeg, image/jpg, image/png, image/bmp',
                            'class' => 'file-deletable'
                        ],
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-default btn-block',
                            'initialPreview' => [
                                $formModel->photo ? \yii\helpers\Html::img($formModel->photoUrl, ['class' => 'file-preview-image']) : null
                            ]
                        ]
                    ]) ?>

                    <?= $form->field($formModel, 'deletePhoto', ['options' => ['class' => 'form-group hidden']])->hiddenInput(['class' => 'file-deleter']) ?>

                    <?= $form->field($formModel, 'login') ?>

                    <?= $form->field($formModel, 'password', [
                        'template' => "{label}\n{input}\n{error}\n" . '<button class="btn btn-default btn-block generate-password hidden" type="button"><i class="glyphicon glyphicon-cog"></i> ' . Yii::t('admin', 'Сгенерировать пароль') . '</button><button class="btn btn-default btn-block change-password" type="button"><i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('admin', 'Изменить пароль') . '</button>',
                        'inputOptions' => [
                            'class' => 'form-control password hidden'
                        ]
                    ]) ?>

                    <?= $form->field($formModel, 'fullname') ?>

                    <?= $form->field($formModel, 'email') ?>
                </div>

                <div class="panel-footer clearfix">
                    <div class="pull-right">
                        <button class="btn btn-primary" type="submit"><?= \Yii::t('admin', 'Сохранить') ?></button>
                        <button class="btn btn-default" type="button">
                            <a href="<?= \yii\helpers\Url::to(['user/default']) ?>" data-pjax="pjax-content"><?= \Yii::t('admin', 'Отмена') ?></a>
                        </button>
                    </div>
                </div>
            </div>

            <?php \yii\bootstrap\ActiveForm::end() ?>
        <?php } else { ?>
            <div class="alert alert-danger">Пользователь не найден <a class="pull-right" href="<?= \yii\helpers\Url::to(['user/default']) ?>" data-pjax="pjax-content"><?= \Yii::t('admin', 'Назад') ?></a></div>
        <?php } ?>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
