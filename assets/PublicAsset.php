<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/bootstrap.min.css',
        'public/css/font-awesome.min.css',
        'public/css/animate.min.css',
        'public/css/owl.carousel.css',
        'public/css/owl.theme.css',
        'public/css/owl.transitions.css',
        'public/style.css',
        'public/css/responsive.css',
    ];
    public $js = [
        'text/javascript" src="assets/js/bootstrap.min.js',
        'text/javascript" src="assets/js/owl.carousel.min.js',
        'text/javascript" src="assets/js/jquery.stickit.min.js',
        'text/javascript" src="assets/js/menu.js',
        'text/javascript" src="assets/js/scripts.js',
    ];

    public $depends = [

    ];
}
