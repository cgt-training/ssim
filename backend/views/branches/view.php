<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-view">

    <p>
      <?php
        if(Yii::$app->user->isGuest == false){
        echo   Html::a('Update', ['update', 'id' => $model->branch_id], ['class' => 'btn btn-primary']);
        echo  ' '.Html::a('Delete', ['delete', 'id' => $model->branch_id], [
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
            'company.company_name',
            'branch_id',
            'branch_name',
            'branch_address',
            'branch_status',
            'branch_created_date',
        ],
    ]) ?>

</div>
