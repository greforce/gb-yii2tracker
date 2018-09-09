<?php

namespace frontend\modules\api\controllers;

use Yii;
use frontend\modules\api\models\ProjectApi;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

/**
 * UserController implements the CRUD actions for User model.
 */
class ProjectController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\ProjectApi';

}
