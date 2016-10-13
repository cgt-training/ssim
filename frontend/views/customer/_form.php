<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->widget(Select2::classname(), [
				'data' => ArrayHelper::map($locations,'zip_code','zip_code'),
				'language' => 'en',
				'options' => ['placeholder' => 'Select Zipcode'],
				'pluginOptions' => [
				'allowClear' => true
				],
				'pluginEvents' => [
				'change' => "function(){
					$.post(
						'".Url::toRoute('location/get-location')."',
						{zipcode:$(this).val()},
						function(response){
							$('#city').val(response.city);
                            $('#province').val(response.province);
						},'json'
					);
				}"
				]
				]);?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true,'id' => 'city','readonly' => 'readonly']) ?>

    <?= $form->field($model, 'provience')->textInput(['maxlength' => true, 'id' => 'province','readonly' => 'readonly']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
