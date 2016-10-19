<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="box box-primary">
<div class="user-update">
  <div class = "box-header with-border">
    <h3 class="box-title"><?= Html::encode('Update User: ' . $model->id) ?></h3>
  </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'auth_roles' =>  $auth_roles
    ]) ?>
    </div>
</div>
</div>