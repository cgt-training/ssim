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
<div class="location-index">

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
]); ?>
<?php Pjax::end()?>
</div>

<?=$this->registerJsFile('@jspath/location.js', ['depends' => [yii\web\JqueryAsset::className()]]);