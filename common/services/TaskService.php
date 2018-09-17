<?php
namespace common\services;

use common\models\Project;
use common\models\Task;
use common\models\User;
use common\models\ProjectUser;
use Yii;

class TaskService extends \yii\base\Component
{

    public function canManage(Project $project, User $user)
    {
        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER);
    }

    public function canTake(Task $task, User $user)
    {
        return Yii::$app->projectService->hasRole($task->project, $user, ProjectUser::ROLE_DEVELOPER) && $task->executor_id === null;
    }

    public function canComplete(Task $task, User $user)
    {
        return $task->executor_id === $user->id && $task->completed_at === null;
    }

    public function takeTask(Task $task, User $user)
    {
        $task->executor_id = $user->id;
        $task->started_at = time();
    }

    public function completeTask(Task $task, User $user)
    {
        if ($this->canComplete($task, $user)) {
            $task->completed_at = time();
        }
    }

}
