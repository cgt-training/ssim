<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
<div class="row header">
	<div class="col-md-1"></div>
	<div class="col-md-10 container">
		<div class="pull-left"><?=Html::img('@imagepath/logo.png',['class'=>'img-responsive'])?></div>
		<div class="pull-left heading">
			<h2>Sri Sukhmani Institute of Management</h2>
			<span>(Approved by A.I.C.T.E., Ministry of HRD, Govt. of India)</span>
		</div>
		<div>
			<input type="text" class="pull-right" name="search" placeholder="Search">
		</div>
	</div>
	<div class="col-md-1"></div>
	</div>

	<div class="row">
        <div class="col-md-1"></div>
        <div class="container col-md-10 content-box">
        <div>
                <?php
                //Bootstrap Navbar
                    NavBar::begin([
                        'brandLabel' => false,
                        'options' => [
                            'class' => 'navbar-inverse ',
                        ],
                        'innerContainerOptions' =>[
                            'class' => ''
                        ],
                        'screenReaderToggleText' => ''
                    ]);
                    $menuItems = [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'About Us', 'url' => ['/site/about']],
                        ['label' => 'Courses', 'url' => ['/']],
                        ['label' => 'Company', 'url' => ['/company/index']],
                        ['label' => 'Department', 'url' => ['/department/index']],
                        ['label' => 'Branches', 'url' => ['/branches/index']],
                    ];
                    if (Yii::$app->user->isGuest) {
                        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                    } else {
                        $menuItems[] =  ['label' => 'Profile', 'url' => ['/user/profile']];
                        $menuItems[] = '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link']
                            )
                            . Html::endForm()
                            . '</li>';
                    }
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav '],
                        'items' => $menuItems,
                    ]);
                    NavBar::end();
                    ?>

		</div>

		<div class="banner">
			<div class="banner-content">
				<div>admission open - pgdm</div>
				<div>post graduate diploma in management</div>
				<div>Two year full time programme</div>
				<span>Specialized in Finance Marketing and Retail Marketing</span>
			</div>
		</div>
<!--
        <div class="row gallery">
                <div class="image-box col-xs-6 col-md-3">
                    <?=Html::img('@imagepath/image2.png',['class'=>'img-responsive center-block'])?>
            </div>
            <div class="image-box col-xs-6 col-md-3">
                    <?=Html::img('@imagepath/image1.png',['class'=>'img-responsive center-block'])?>
            </div>
            <div class="image-box col-xs-6 col-md-3">
                    <?=Html::img('@imagepath/image1.png',['class'=>'img-responsive center-block'])?>
            </div>
            <div class="image-box col-xs-6 col-md-3">
                    <?=Html::img('@imagepath/image2.png',['class'=>'img-responsive center-block'])?>
            </div>
        </div>
-->
        <?=$content?>

	<div class="row footer">
		<div class="col-md-12">
			<div class="col-md-9">
				<span>2016 SSIM All right Reserved</span>
			</div>
			<div class="col-md-3">
				<span>Follow Us <i class="fa fa-twitter-square"></i><i class="fa fa-facebook-square"></i><i class="fa fa-google-plus-square"></i></span><br>
				<span>Powered By CG Technosoft</span>
			</div>
		</div>
	</div>
	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>