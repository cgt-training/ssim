<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = 'Department';
$this->params['breadcrumbs'][] = ['label' => 'Department', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view">

    <p>
          <?php
        if(Yii::$app->user->isGuest == false){
         echo Html::a('Update', ['update', 'id' => $model->dept_id], ['class' => 'btn btn-primary']);
         echo ' '.Html::a('Delete', ['delete', 'id' => $model->dept_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dept_id',
            'dept_name',
            'dept_status',
            'company.company_name',
            'branches.branch_name',
            'dept_created_date',
        ],
    ]) ?>

</div>
