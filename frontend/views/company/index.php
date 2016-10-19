<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use yii\helpers\Url;

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=Html::a('List',['list'],['class' => 'btn btn-info', 'id' => 'company_list']);?>

<?php
    // Modal for Create company Form 
    yii\bootstrap\Modal::begin([
        'header' => '<h4 class="modal-title">Create Company</h4>
        <div class="alert alert-success success-message">
            <strong>Success! New company created.</strong>
        </div>',
        'id' => 'create_company_modal',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'><div class='text-center'><span class='glyphicon glyphicon-refresh spinner' aria-hidden='true'></span></div></div>";
    yii\bootstrap\Modal::end();
?>

<?php 
  //GridView Started
    Pjax::begin(['id' => 'company_pjax']); ?>
<?= GridView::widget([
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
                    'update'=> false,
                    'delete' => false,
                ],
                'buttons' => [
                    'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['class'=>"delete-request"]);
                    },
                ],                
			],
        ],
        'rowOptions' => function ($searchModel){   
            if($searchModel->company_status == 'active') {
                return ['class' => 'success'];
            }
            else{
                return ['class' => 'danger'];
            }
        }
    ]); ?>
<?php Pjax::end(); ?></div>

<?=$this->registerJsFile('@jspath/company.js',['depends' => [yii\web\JqueryAsset::className()]]);