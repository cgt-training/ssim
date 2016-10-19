<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use yii\helpers\Url;

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>

   <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
            <div class="branches-index">

            <p>
                <?= Yii::$app->user->isGuest == false ? Html::button('Create Branches', ['value' => Url::to('create'), 'class' => 'btn btn-success' ,'id' => 'create_branch']) : '' ;?>
            </p>

            <?php
                // Modal for Create Branch Form 
                yii\bootstrap\Modal::begin([
                    'header' => '<h4 class="modal-title">Create Branch</h4>
                    <div class="alert alert-success success-message">
                        <strong>Success! New branch created.</strong>
                    </div>',
                    'id' => 'create_branch_modal',
                    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
                ]);
                echo "<div id='modalContent'><div class='text-center'><span class='glyphicon glyphicon-refresh spinner' aria-hidden='true'></span></div></div>";
                yii\bootstrap\Modal::end();
            ?>

            <?php
                //GridView Started
                Pjax::begin(['id' => 'branches_pjax']);
            ?>    
            <?= GridView::widget([
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
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['class'=>"delete-request"]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?></div>
            </div>
        </div>
    </div>
</div>
<?=$this->registerJsFile('@jspath/branches.js',['depends' => [yii\web\JqueryAsset::className()]]);