<?php
namespace frontend\modules\api\models;

use Yii;
use common\models\User;

/**
 * UserApi model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $avatar
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @mixin getThumbUploadUrl
 */
class UserApi extends User
{

    public function fields()
    {
        return ['id', 'name' => function($model) {
            return $model->username;
        }];
    }

    public function extraFields()
    {
        return ['projectUsers', 'projects'];
    }

}
