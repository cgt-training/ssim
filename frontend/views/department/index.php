<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title= 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-index">
	 <h1><?= Html::encode($this->title) ?></h1>

	<?=Html::a('Create Department',['create'],['class'=>'btn btn-success']);?>
</div>

<?php
	Pjax::begin();?>

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
          	'dept_name',
          	[
			'attribute'=>'company_name',
			'value' => 'company.company_name'
          	],
          	[
			'attribute'=>'branch_name',
			'value' => 'branches.branch_name'
          	],
			'dept_status',
 			 [
                'attribute' => 'dept_created_date',
                'value' => 'dept_created_date',
                'filter' => \yii\jui\DatePicker::widget([   'attribute'=>'dept_created_date','model' => $searchModel,'dateFormat' => 'yyyy-MM-dd']),
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php	Pjax::end();
?>