<?php //

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Description of PluginAsset
 *
 * @author bikas
 */
class PluginAsset extends AssetBundle {

    public $sourcePath = '@backend/web/plugins';
    public $css = [
//     datatable start
        'datatables-bs4/css/dataTables.bootstrap4.min.css',
        'datatables-responsive/css/responsive.bootstrap4.min.css',
        'datatables-buttons/css/buttons.bootstrap4.min.css',
//        end
    ];
    public $js = [
//        datatable
        'js/datatableprint.js',
        'datatables/jquery.dataTables.min.js',
        'datatables-bs4/js/dataTables.bootstrap4.min.js',
        'datatables-responsive/js/dataTables.responsive.min.js',
        'datatables-responsive/js/responsive.bootstrap4.min.js',
        'datatables-buttons/js/dataTables.buttons.min.js',
        'datatables-buttons/js/buttons.bootstrap4.min.js',
        'jszip/jszip.min.js',
        'pdfmake/pdfmake.min.js',
        'pdfmake/vfs_fonts.js',
        'datatables-buttons/js/buttons.html5.min.js',
        'datatables-buttons/js/buttons.print.min.js',
        'datatables-buttons/js/buttons.colVis.min.js',
    ];
    public $depends = [
        'hail812\adminlte3\assets\BaseAsset'
    ];
    public static $pluginMap = [
        'fontawesome' => [
            'css' => 'fontawesome-free/css/all.min.css'
        ],
        'icheck-bootstrap' => [
            'css' => ['icheck-bootstrap/icheck-bootstrap.css']
        ]
    ];

    /**
     * add a plugin dynamically
     * @param $pluginName
     * @return $this
     */
    public function add($pluginName) {
        $pluginName = (array) $pluginName;

        foreach ($pluginName as $name) {
            $plugin = $this->getPluginConfig($name);
            if (isset($plugin['css'])) {
                foreach ((array) $plugin['css'] as $v) {
                    $this->css[] = $v;
                }
            }
            if (isset($plugin['js'])) {
                foreach ((array) $plugin['js'] as $v) {
                    $this->js[] = $v;
                }
            }
        }

        return $this;
    }

    /**
     * @param $name plugin name
     * @return array|null
     */
    private function getPluginConfig($name) {
        return self::$pluginMap[$name] ?? \Yii::$app->params['hail812/yii2-adminlte3']['pluginMap'][$name] ?? null;
    }

}
