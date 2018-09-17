<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ProjectUser;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if(Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER)) {?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php }?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'estimation:datetime',
            [
                'attribute' => 'executor_id',
                'value' => function($model) {
                    if ($model->executor) {
                        return $model->executor->username;
                    } else {
                        return 'Не назначен';
                    }
                },
            ],
            'started_at:datetime',
            'completed_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => function($model) {
                    return $model->creator->username;
                },
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model) {
                    return $model->updater->username;
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
        'model' => $model,
    ]); ?>

</div>
