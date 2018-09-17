<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'username',
                'value' => function($model) {
                  return Html::a($model->username, ['view', 'id' => $model->id]);
                },
                'format' => 'html',
            ],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => User::STATUSES,
                'value' => function($model) {
                    return User::STATUSES[$model->status];
                },
            ],
            //'created_at',
            //'updated_at',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
