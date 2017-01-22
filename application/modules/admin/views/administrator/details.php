<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-content',
    'linkSelector' => 'a[data-pjax=pjax-content]',
    'formSelector' => 'form[data-pjax=pjax-content]',
    'timeout' => 30000
]) ?>

<?php $this->title = Yii::t('admin', 'Администрация') ?>

<?= $this->render('/chunks/breadcrumbs', [
    'links' => [
        [
            'label' => Yii::t('admin', 'Администрация'),
            'url' => ['administrator/default'],
            'data-pjax' => 'pjax-content'
        ],
        [
            'label' => $administrator->fullname
        ]
    ]
]) ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?= \yii\widgets\DetailView::widget([
            'model' => $administrator,
            'attributes' => [
                'id',
                'login',
                'fullname',
                'email',
                'created_at',
                'updated_at'
            ]
        ]) ?>

        <div>
            <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['administrator/update', 'id' => $administrator->id]) ?>">
                <i class="glyphicon glyphicon-pencil"></i>
            </a>

            <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['administrator/delete', 'id' => $administrator->id]) ?>">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
