<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Yii::$app->user->isGuest == false ? Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) : '';?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'company_id',
            'company_name',
            'company_email:email',
            'company_address',
            [
                'attribute' => 'registration_date',
                'value' => 'registration_date',
                'filter' => \yii\jui\DatePicker::widget([   'attribute'=>'registration_date','model' => $searchModel,'dateFormat' => 'yyyy-MM-dd']),
                'format' => 'html',
            ],
            'company_status',
            [
                'attribute'=>'logo',
                'value'=> function($dataProvider){
                        if(!empty($dataProvider->logo)){
                            return Html::img('@company_logo_path/'.$dataProvider->logo,
                            ['width' => '60px']);
                        }
                        else{
                            return '';
                        }
                },
                'format' =>'html',
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