<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['id' => 'form_company',]); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <?=$form->field($model,'registration_date')->widget(
    DatePicker::className(),[
          'inline' => true, 
         // modify template for custom rendering
        'template' => '<div class="input-group date" data-provide="datepicker">
            {input}
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ]);?>

    <?=$form->field($model,'file')->fileInput()->label('Company Logo');?>

    <div class="row">
      <?php       
        if(!empty($model->getAttribute('logo')))
        {
            $logo  = Html::img('@company_logo_path/'.$model->getAttribute('logo').'?'.time(),['class'=>'img-responsive center-block']);
            echo Html::tag('div', $logo, ['class' => 'file-preview-frame col-md-3']);
            // echo Html::a('Remove',Url::to('remove-logo?id='.$model->company_id),['class' => 'btn btn-danger',]);
        }
      ?>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>