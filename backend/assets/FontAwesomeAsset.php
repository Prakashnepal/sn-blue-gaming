<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace backend\assets;
use yii\web\AssetBundle;
/**
 * Description of FontAwesomeAsset
 *
 * @author bikas
 */
class FontAwesomeAsset extends AssetBundle {
    public $sourcePath = '@backend/web/plugins/fontawesome-free';

    public $css = [
        'css/all.min.css'
    ];
}
