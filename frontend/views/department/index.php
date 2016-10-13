<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title= 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-index">
	 <h1><?= Html::encode($this->title) ?></h1>

	  <?= Yii::$app->user->isGuest == false ? Html::button('Create Department', ['value' => Url::to('create'), 'class' => 'btn btn-success' ,'id' => 'create_department']) : '' ;?>
</div>

<?php
    // Modal for Create department Form 
    yii\bootstrap\Modal::begin([
        'header' => '<h4 class="modal-title">Create Department</h4>',
        'id' => 'create_department_modal',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'><div class='text-center'><span class='glyphicon glyphicon-refresh spinner' aria-hidden='true'></span></div></div>";
    yii\bootstrap\Modal::end();
?>

<?php
    //GridView Started
	Pjax::begin();
?>

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
            ['class' => 'yii\grid\ActionColumn',
			     'visibleButtons' => [
                    'update'=> function () {
                        return Yii::$app->user->isGuest ? false : true;
                     },
                    'delete' => function () {
                        return Yii::$app->user->isGuest ? false : true;
                     },
                ],
			],
        ],
    ]); ?>

<?php	Pjax::end();
?>