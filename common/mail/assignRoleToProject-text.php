<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>

Hello <?= Html::encode($user->username) ?>,

In project <?= $project->title ?> you got assigned a role <?= $role ?>
