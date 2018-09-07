<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Condensed&amp;subset=cyrillic,cyrillic-ext',
        'css/font-awesome.min.css',
        'css/animate.css',
        'css/style.css'
    ];
    public $js = [
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
