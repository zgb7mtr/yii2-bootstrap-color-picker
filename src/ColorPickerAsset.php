<?php
/**
 * Created by PhpStorm.
 * @author Tommy Zheng <tommy@vlv.pw>
 * @link https://github.com/zgb7mtr/yii2-bootstrap-color-picker
 */
namespace zgb7mtr\colorPicker;

use yii\web\AssetBundle;

class ColorPickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/bootstrap-colorpicker/dist';

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    public function init() {
        $this->css[] = YII_DEBUG ? 'css/bootstrap-colorpicker.css' : 'css/bootstrap-colorpicker.min.css';
        $this->js[] = YII_DEBUG ? 'js/bootstrap-colorpicker.js' : 'js/bootstrap-colorpicker.min.js';
    }
}