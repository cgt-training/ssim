<?php
use yii\helpers\Html;

$this->title= 'Create Department';
$this->params['breadcrumbs'][] = ['label'=>'Department','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-create">
	<h1><?=Html::encode($this->title)?></h1>
	<?=$this->render('_form',[
		'model' => $model,
		'company' => $company,
		'branch' => $branch,
	]);
	?>

</div>