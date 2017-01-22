<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-content',
    'linkSelector' => 'a[data-pjax=pjax-content]',
    'formSelector' => 'form[data-pjax=pjax-content]',
    'timeout' => 30000
]) ?>

<?php $this->title = Yii::t('admin', 'Пользователи') ?>

<?= $this->render('/chunks/breadcrumbs', [
    'links' => [
        ['label' => Yii::t('admin', 'Пользователи')]
    ]
]) ?>

<div class="row">
    <a href="<?= \yii\helpers\Url::to(['user/create']) ?>" data-pjax="pjax-content"><i class="glyphicon glyphicon-plus"></i> Создать нового</a>
</div>

<div class="row">
    <?= \yii\grid\GridView::widget([
        'caption' => Yii::t('admin', 'Пользователи'),
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                    'size' => 1
                ]
            ],
            [
                'attribute' => 'photo',
                'content' => function ($model) {
                    return \yii\helpers\Html::img($model->getPhotoUrl([50, 50]), ['class' => 'img-rounded']);
                }
            ],
            [
                'attribute' => 'login',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm'
                ]
            ],
            [
                'attribute' => 'fullname',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm'
                ]
            ],
            [
                'attribute' => 'email',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm'
                ]
            ],
            [
                'attribute' => 'created_at',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm'
                ]
            ],
            [
                'attribute' => 'updated_at',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm'
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => [
                    'data-pjax' => 'pjax-content'
                ]
            ]
        ],
        'filterModel' => $filterModel,
    ]) ?>
</div>

<?php \yii\widgets\Pjax::end() ?>
