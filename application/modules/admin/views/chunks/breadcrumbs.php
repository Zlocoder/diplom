<div class="row">
    <?= \yii\widgets\Breadcrumbs::widget([
        'homeLink' => [
            'label' => '<i class="glyphicon glyphicon-home"></i>',
            'url' => ['dashboard/default'],
            'encode' => false,
            'data-pjax' => 'pjax-main'
        ],
        'links' => $links
    ]) ?>
</div>
