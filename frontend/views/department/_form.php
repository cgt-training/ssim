<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
?>

  <div class="department-form">

    <?php $form = ActiveForm::begin(['id' => 'department_form'])?>

  	<?=$form->field($model,'company_id')->widget(Select2::classname(), [
				'data' => ArrayHelper::map($company,'company_id','company_name'),
				'language' => 'en',
				'options' => ['placeholder' => 'Select Company'],
				'pluginOptions' => [
				'allowClear' => true
				],
				'pluginEvents' => [
				'change' => "function(){
					$.post(
						'".Url::toRoute('get-company-branches')."',
						{id:$(this).val()},
						function(response){
							$('#branches').html(response);
						}
					);
				}"
				]
				]);
		?>

    <?=$form->field($model,'branch_id')->widget(Select2::classname(), [
				// 'data' => ArrayHelper::map($branch,'branch_id','branch_name'),
				'language' => 'en',
				'options' => ['placeholder' => 'Select Branch','id' => 'branches'],
				'pluginOptions' => [
				'allowClear' => true
				],
				]);
		?>

    <?=$form->field($model,'dept_name');?>

  	<?= $form->field($model, 'dept_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>
             
		<div class="form-group">
			<?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update',['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
		</div>

   <?php ActiveForm::end()?>
  </div>