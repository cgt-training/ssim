<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
                <div class="location-index">

                <p>
                    <?= Html::button('Create Location',  ['value'=>Url::toRoute('create'), 'class' => 'btn btn-success','id' => 'create_location']) ?>
                </p>

                <?php
                    // Modal for Create location Form 
                    yii\bootstrap\Modal::begin([
                        'header' => '<h4 class="modal-title">Create Location</h4>
                        <div class="alert alert-success success-message">
                            <strong>Success! New location created.</strong>
                        </div>',
                        'id' => 'create_location_modal',
                        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
                    ]);
                    echo "<div id='modalContent'><div class='text-center'><span class='glyphicon glyphicon-refresh spinner' aria-hidden='true'></span></div></div>";
                    yii\bootstrap\Modal::end();
                ?>

                <?php Pjax::begin(['id' => 'location_pjax']);?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'location_id',
                        'zip_code',
                        'city',
                        'province',
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
                <?php Pjax::end()?>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->registerJsFile('@jspath/location.js', ['depends' => [yii\web\JqueryAsset::className()]]);