<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div>
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>In project <?= $project->title ?> you got assigned a role <?= $role ?> </p>
</div>
