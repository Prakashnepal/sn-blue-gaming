<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Description of AdminLteAsset
 *
 * @author bikas
 */
class AdminLteAsset extends AssetBundle {

    public $sourcePath = '@backend/web/dist';
    public $css = [
        'css/adminlte.min.css'
    ];
    public $js = [
        'js/adminlte.min.js'
    ];
    public $depends = [
        'hail812\adminlte3\assets\BaseAsset',
        'hail812\adminlte3\assets\PluginAsset'
    ];

}
