<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title= 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>

   <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
            <div class="department-index">
                <?= Yii::$app->user->isGuest == false ? Html::button('Create Department', ['value' => Url::to('create'), 'class' => 'btn btn-success' ,'id' => 'create_department']) : '' ;?>
            </div>

            <?php
                // Modal for Create department Form 
                yii\bootstrap\Modal::begin([
                    'header' => '<h4 class="modal-title">Create Department</h4>
                    <div class="alert alert-success success-message">
                        <strong>Success! New department created.</strong>
                    </div>',
                    'id' => 'create_department_modal',
                    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
                ]);
                echo "<div id='modalContent'><div class='text-center'><span class='glyphicon glyphicon-refresh spinner' aria-hidden='true'></span></div></div>";
                yii\bootstrap\Modal::end();
            ?>

            <?php
                //GridView Started
                Pjax::begin(['id' => 'department_pjax']);
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
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['class'=>"delete-request"]);
                                },
                            ],                
                        ],
                    ],
                    'tableOptions' => ['class' => 'table table-bordered table-hover'],
                     'rowOptions' => function ($searchModel){   
                        if($searchModel->dept_status == 'active') {
                            return ['class' => 'success'];
                        }
                        else{
                            return ['class' => 'danger'];
                        }
                    },
                ]); ?>

            <?php	Pjax::end();?>
            </div>
        </div>
    </div>
</div>
<?=$this->registerJsFile('@jspath/department.js',['depends' => [yii\web\JqueryAsset::className()]]);