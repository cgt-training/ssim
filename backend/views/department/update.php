<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Update Department: ' . $model->dept_id;
$this->params['breadcrumbs'][] = ['label' => 'Department', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dept_id, 'url' => ['view', 'id' => $model->dept_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company' => $company,
        'branch' => $branches
    ]) ?>

</div>
