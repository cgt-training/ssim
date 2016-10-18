<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        'css/skins/skin-purple-light.min.css',
        'css/iCheck/square/purple.css',
        'css/datepicker/datepicker3.css',
        'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/icheck.min.js',
        'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        'js/datepicker/bootstrap-datepicker.js',
        'js/slimScroll/jquery.slimscroll.min.js',
        'js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'js/app.min.js',
        'js/dashboard.js'
    ];  
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
