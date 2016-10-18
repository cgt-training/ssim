<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo Html::button('Go Back',['class' => 'btn btn-default pull-right back-button','data-url' => Url::toRoute('index')]);
?>
<div class="company-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'attribute' => 'company_name',
            ],
            [
                'attribute'=>'logo',
                'value'=> function($dataProvider){
                        if(!empty($dataProvider->logo)){
                            return Html::img('@company_logo_path/'.$dataProvider->logo,
                            ['width' => '200px']);
                        }
                        else{
                            return '';
                        }
                },
                'format' =>'html',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]   ); ?>
<?php Pjax::end(); ?>
</div>

</div>
