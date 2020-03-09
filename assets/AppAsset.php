<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/add_order_form.css',
        'css/orders_list.css',
	    'https://unpkg.com/leaflet@1.6.0/dist/leaflet.css',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'
    ];
    public $js = [
    	'https://unpkg.com/leaflet@1.6.0/dist/leaflet.js',
        'js/geocode.js',
        'js/orders.js',
    	'js/map.js',
        'js/index.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
