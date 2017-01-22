<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-content',
    'linkSelector' => 'a[data-pjax=pjax-content]',
    'formSelector' => 'form[data-pjax=pjax-content]',
    'timeout' => 30000
]) ?>

<?php $this->title = Yii::t('admin', 'Администрация') ?>

<?= $this->render('/chunks/breadcrumbs', [
    'links' => [
        ['label' => Yii::t('admin', 'Администрация')]
    ]
]) ?>

<?= \yii\grid\GridView::widget([
    'caption' => Yii::t('admin', 'Администрация'),
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'fullname',
        'email',
        'created_at',
        'updated_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'buttonOptions' => [
                'data-pjax' => 'pjax-content'
            ]
        ]
    ]
]) ?>


<?php \yii\widgets\Pjax::end() ?>
