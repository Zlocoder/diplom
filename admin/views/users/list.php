<?php
/* @var $this yii\web\View */
/* @var $filter object */

use yii\bootstrap\Nav;
use yii\helpers\Html;
?>

<?= \yii\widgets\Breadcrumbs::widget([
    'homeLink' => ['label' => 'Панель управления', 'url' => ['admin/index']],
    'links' => [
        ['label' => 'Пользователи']
    ]
]) ?>

<p>
    <?= Html::a('Создать', ['create'], ['class' => 'btn btn-primary']); ?>
</p>


<div  class="panel panel-default">
    <div class="panel-body">
        <?= \yii\grid\GridView::widget([
            'filterModel' => $filter,
            'dataProvider' => $filter->provider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'avatar',
                    'content' => function($user) {
                        if ($user->avatar) {
                            return Html::img($user->getAvatarUrl([50, 50]));
                        }

                        return null;
                    }
                ],
                'login',
                'email',
                [
                    'attribute' => 'date_add',
                    'filter' => '
                <div class="input-group input-daterange">
                    <input type="text" class="form-control" name="UsersFilter[date_from]" value="' . $filter->date_from . '" data-date-end-date="' . date('Y-m-d') . '">
                    <span class="input-group-addon">to</span>
                    <input type="text" class="form-control" name="UsersFilter[date_to]" value="' . $filter->date_to . '" data-date-end-date="' . date('Y-m-d') . '">
                </div>
                ' . (($filter->hasErrors('date_from') || $filter->hasErrors('date_to')) ? '<div class="help-block">' . $filter->errors['date_from'][0] . ' ' . $filter->errors['date_to'][0] : null) . '
            ',
                    'filterOptions' => [
                        'class' => ($filter->hasErrors('date_from') || $filter->hasErrors('date_to')) ? 'has-error' : null
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'
                ]

            ],
            'options' => ['class' => 'panel-body grid-view'],
            'summary' => '<div class="summary" >Показано {count} из {totalCount} (c {begin} по {end}) . Страница {page} из {pageCount}.</div>',
            'tableOptions' => ['class' => 'table']
        ]); ?>
    </div>
</div>
