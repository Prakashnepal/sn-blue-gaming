<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/fontawesome-free/css/all.min.css', // fontawesome 
        'dist/css/adminlte.min.css', // adminlte
        'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
//        'css/jquery.dataTables.css',
    ];
    public $js = [
        'dist/js/adminlte.min.js',
        //start plugin
        'plugins/bootstrap/js/bootstrap.bundle.js',
        'plugins/sweetalert2/sweetalert2.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap4\BootstrapAsset',

        'hail812\adminlte3\assets\BaseAsset',
//        'hail812\adminlte3\assets\PluginAsset',
        'fedemotta\datatables\DataTablesAsset',
    ];

}
