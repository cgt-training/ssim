<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = $model->company_id;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    // if(Yii::$app->session->hasFlash('invalidImageExtension')){
    //    echo  Alert::widget([
    //     'options' => ['class' => 'alert-info'],
    //     'body' => Yii::$app->session->getFlash('invalidImageExtension'),
    //     ]);
    // }
    ?>
    <p>
        <?php
        if(Yii::$app->user->isGuest == false){
      //  echo  Html::a('Update', ['update', 'id' => $model->company_id], ['class' => 'btn btn-primary update-company']);
        // echo ' '.Html::a('Delete', ['delete', 'id' => $model->company_id], [
        //     'class' => 'btn btn-danger delete-company',
        // ]);
        }
        echo Html::button('Go Back',['class' => 'btn btn-default pull-right back-button','data-url' => Url::toRoute('index')]);
         ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'company_id',
            'company_name',
            'company_email:email',
            'company_address',
            'company_created_date',
            'company_status',
            [
                'attribute'=>'logo',
             'value'=>'@company_logo_path/'.$model->logo.'?'.time(),
    'format' => ['image',['width'=>'100','height'=>'100']],
            ]
        ],
    ]) ?>

</div>
