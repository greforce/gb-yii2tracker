<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\ProjectUser;
use common\models\User;
use common\models\Project;
use yii\helpers\ArrayHelper;
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
            [
                'attribute' => 'project_id',
                'label' => 'Project',
                'filter' => ArrayHelper::map(Project::find()
                  ->select('id, title')
                  ->where(['id' => $searchModel->find()->select('project_id')])
                  ->asArray()
                  ->all(), 'id', 'title'),
                'value' => function($model) {
                  return Html::a($model->project->title, ['project/view', 'id' => $model->project->id]);
                },
                'format' => 'html',
            ],
            'title',
            'description:ntext',
            'estimation:datetime',
            [
                'attribute' => 'executor_id',
                'label' => 'Executor',
                'filter' => ArrayHelper::map(User::find()
                  ->select('id, username')
                  ->where(['id' => $searchModel->find()->select('executor_id')])
                  ->asArray()
                  ->all(), 'id', 'username'),
                'value' => function($model) {
                  return Html::a(User::findOne($model->executor_id)->username, ['user/view', 'id' => $model->executor_id]);
                },
                'format' => 'html',
            ],
            'started_at:datetime',
            'completed_at:datetime',
            [
                'attribute' => 'created_by',
                'label' => 'Creator',
                'filter' => ArrayHelper::map(User::find()
                  ->select('id, username')
                  ->where(['id' => $searchModel->find()->select('created_by')])
                  ->asArray()
                  ->all(), 'id', 'username'),
                'value' => function($model) {
                  return Html::a(User::findOne($model->created_by)->username, ['user/view', 'id' => $model->created_by]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'updater.username',
                'label' => 'Updater',
                'value' => function($model) {
                  return Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id' => $model->updated_by]);
                },
                'format' => 'html',
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take} {complete}',
                'buttons' => [
                    'take' => function($url, $model, $key) {
                      $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], [
                          'data' => [
                              'confirm' => 'Take this task?',
                              'method' => 'post',
                          ],
                        ]);
                    },
                    'complete' => function($url, $model, $key) {
                      $icon = \yii\bootstrap\Html::icon('ok');
                        return Html::a($icon, ['task/complete', 'id' => $model->id], [
                          'data' => [
                              'confirm' => 'Are you sure that task completed?',
                              'method' => 'post',
                          ],
                        ]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function($model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'delete' => function($model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'take' => function($model, $key, $index) {
                        return Yii::$app->taskService->canTake($model, Yii::$app->user->identity);
                    },
                    'complete' => function($model, $key, $index) {
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
