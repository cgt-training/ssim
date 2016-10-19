<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
  <div class="profile row col-md-6">
  <div class="box box-primary">
  <div class = "box-header with-border">
    <h3 class="box-title">Profile</h3>
  </div>
  <div class="box-body">
    <?php
    $this->title = 'User Profile';
    $this->params['breadcrumbs'][] = $this->title;

     $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

      <?= $form->field($model, 'username',  [
                                'template' => '{label}{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>',
                            'options' => ['class' => 'form-group has-feedback']])->textInput() ?>
    <?= $form->field($model, 'email',  [
                                'template' => '{label}{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>',
                            'options' => ['class' => 'form-group has-feedback']])->textInput();?>
      <?= $form->field($model, 'file')->fileInput()->label('Profile Image') ?>
      <div class="row">
     <?php       
        if(!empty($model->getAttribute('image') && file_exists(Url::to('@user_profile_photo_path/'.$model->getAttribute('image')))))
        {
            $image  = Html::img('@user_profile_photo_path/'.$model->getAttribute('image'),['class'=>'img-responsive center-block']);
            echo Html::tag('div', $image, ['class' => 'file-preview-frame col-md-3']);
            echo Html::a('Remove',Url::to('remove-image?id='.$model->id),['class' => 'btn btn-danger btn-xs',
                'data' => [
                  'confirm' => 'Are you sure you want to remove this image?',
                ]]);
        }
      ?>
      </div>
      </div>
      <div class="box-footer">
              <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
              </div>
      </div>
              <?php ActiveForm::end(); ?>
    </div>
  </div>