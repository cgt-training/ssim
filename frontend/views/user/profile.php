<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
  <div class="profile">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

      <?=$form->field($model, 'username')->textInput() ?>
      <?= $form->field($model, 'email')->textInput();?>
      <?= $form->field($model, 'file')->fileInput()->label('Profile Image') ?>
      <div class="row">
     <?php       
        if(!empty($model->getAttribute('image')))
        {
            $image  = Html::img('@user_profile_photo_path/'.$model->getAttribute('image'),['class'=>'img-responsive center-block']);
            echo Html::tag('div', $image, ['class' => 'file-preview-frame col-md-3']);
            echo Html::a('Remove',Url::to('remove-image?id='.$model->id),['class' => 'btn btn-danger',
                'data' => [
                  'confirm' => 'Are you sure you want to remove this image?',
                ]]);
        }
      ?>
      </div>
              <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
              </div>
              <?php ActiveForm::end(); ?>

  </div>
  <!-- profile -->