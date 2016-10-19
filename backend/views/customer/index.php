<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>

   <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
                <div class="customer-index">

                <p>
                    <?= Html::button('Create Customer', ['value'=>Url::to('create'), 'class' => 'btn btn-success','id' => 'create_customer']) ?>
                </p>

                <?php
                    // Modal for Create customer Form 
                    yii\bootstrap\Modal::begin([
                        'header' => '<h4 class="modal-title">Create Customer</h4>
                        <div class="alert alert-success success-message">
                            <strong>Success! New customer created.</strong>
                        </div>',
                        'id' => 'create_customer_modal',
                        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
                    ]);
                    echo "<div id='modalContent'><div class='text-center'><span class='glyphicon glyphicon-refresh spinner' aria-hidden='true'></span></div></div>";
                    yii\bootstrap\Modal::end();
                ?>

                <?php   Pjax::begin(['id' => 'customer_pjax']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'customer_id',
                        'customer_name',
                        'zip_code',
                        'city',
                        'provience',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'buttons' => [
                                    'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['class'=>"delete-request"]);
                                    },
                                ],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->registerJsFile('@jspath/customer.js',['depends' => [yii\web\JqueryAsset::className()]]);