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
    <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>