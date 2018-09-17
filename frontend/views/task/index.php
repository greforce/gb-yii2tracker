<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\ProjectUser;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'project.title',
            'title',
            'description:ntext',
            'estimation:datetime',
            'executor.username',
            'started_at:datetime',
            'completed_at:datetime',
            'creator.username',
            'updater.username',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take}',
                'buttons' => [
                    'take' => function($url, $model, $key) {
                      $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], [
                          'data' => [
                              'confirm' => 'Take this task?',
                              'method' => 'post',
                          ],
                        ]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function($model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'delete' => function($model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'take' => function($model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_DEVELOPER);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
