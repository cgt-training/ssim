<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
         <?= Yii::$app->user->isGuest == false ? Html::a('Create Branches', ['create'], ['class' => 'btn btn-success']) : '' ;?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'branch_id',
            [
                'attribute' => 'company_name',
                'value' => 'company.company_name'
            ],
            'branch_name',
            'branch_address',
            [
                'attribute' => 'branch_created_date',
                'value' => 'branch_created_date',
                'filter' => DatePicker::widget([   'attribute'=>'branch_created_date','model' => $searchModel,'dateFormat' => 'yyyy-MM-dd']),
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
<?php Pjax::end(); ?></div>
