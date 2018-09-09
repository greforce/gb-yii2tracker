<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Project;
use common\models\User;
use common\models\ProjectUser;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal',
        'fieldConfig' => [
          'horizontalCssClasses' => [
              'label' => 'col-sm-2',
          ],
        ],
        'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList(Project::STATUSES) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, Project::RELATION_PROJECT_USERS)
        ->widget(MultipleInput::className(), [
              'id' => 'project-users-widget',
              'min' => 0,
              'max' => 10,
              'addButtonPosition' => MultipleInput::POS_HEADER,
              'columns' => [
                  [
                      'name'  => 'project_id',
                      'type'  => 'hiddenInput',
                      'defaultValue' => $model->id,
                  ],
                  [
                      'name'  => 'user_id',
                      'type'  => 'dropDownList',
                      'title' => 'User',
                      'items' => User::find()->select('username')->indexBy('id')->column()
                  ],
                  [
                      'name'  => 'role',
                      'type'  => 'dropDownList',
                      'title' => 'Role',
                      'items' => ProjectUser::ROLES
                  ],
              ]
          ])->label(false) ?>

    <div class="form-group row">
      <div class="col-sm-offset-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
