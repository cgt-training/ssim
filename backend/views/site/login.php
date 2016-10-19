<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

DashboardAsset::register($this); 
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
        <title>Admin | Log in</title>
        <?php $this->head() ?>
</head>

    <body class="hold-transition login-page">
    <?php $this->beginBody() ?>
        <div class="login-box">
            <div class="login-logo">
                <a href="<?=Url::toRoute('index')?>"><b>Admin</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'username',  [
                                'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>',
                            'options' => ['class' => 'form-group has-feedback']])
                                        ->textInput(['autofocus' => true,'placeholder' => 'Username']) ?>
                  
                      <?= $form->field($model, 'password',  [
                                'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>',
                            'options' => ['class' => 'form-group has-feedback']])
                                        ->passwordInput(['autofocus' => true,'placeholder' => 'Password']) ?>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
              <input type="checkbox"> Remember Me
            </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
               <?php ActiveForm::end(); ?>

                <!-- /.social-auth-links -->

                <a href="#">I forgot my password</a><br>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

    <?php $this->registerJsFile('@jspath/login.js',['depends' => yii\web\JqueryAsset::className()]); ?>
    <?php $this->endBody() ?>
    </body>

<?php $this->endPage() ?>
</html>