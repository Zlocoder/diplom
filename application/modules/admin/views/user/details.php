<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-content',
    'linkSelector' => 'a[data-pjax=pjax-content]',
    'formSelector' => 'form[data-pjax=pjax-content]',
    'timeout' => 30000
]) ?>

<?php $this->title = Yii::t('admin', 'Пользователи') ?>

<?= $this->render('/chunks/breadcrumbs', [
    'links' => [
        [
            'label' => Yii::t('admin', 'Пользователи'),
            'url' => ['user/default'],
            'data-pjax' => 'pjax-content'
        ],
        [
            'label' => $user->fullname
        ]
    ]
]) ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <?php if ($user) { ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $user,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'photo',
                        'value' => \yii\helpers\Html::img($user->getPhotoUrl([100, 100]), ['class' => 'img-rounded']),
                        'format' => 'html'
                    ],
                    'login',
                    'fullname',
                    'email',
                    'created_at',
                    'updated_at'
                ]
            ]) ?>

            <div>
                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['administrator/update', 'id' => $user->id]) ?>">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>

                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['administrator/delete', 'id' => $user->id]) ?>">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger">Пользователь не найден</div>
        <?php } ?>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
