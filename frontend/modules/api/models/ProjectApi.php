<?php
namespace frontend\modules\api\models;

use Yii;
use common\models\Project;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property boolean $active
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $creator
 * @property User $updater
 * @property ProjectUser[] $projectUsers
 */
class ProjectApi extends Project
{

    public function fields()
    {
        return ['id', 'title'];
    }

}
