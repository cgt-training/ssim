<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile row col-md-6">
<div class="box box-primary">
<div class = "box-header with-border">
<h3 class="box-title"><?= Html::encode('Create User') ?></h3>
</div>
<div class="box-body">
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'auth_roles' => $auth_roles
    ]) ?>

</div>
</div>
</div>

