<?php
/**
 * Created by PhpStorm.
 * User: Tommy
 * Date: 2017/1/9  0009
 * Time: 14:57:46
 * @author Tommy Zheng <tommy@vlv.pw>
 * @link https://github.com/zgb7mtr/yii2-bootstrap-color-picker
 * @package zgb7mtr\colorPicker
 */
namespace zgb7mtr\colorPicker;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class ColorPicker extends InputWidget
{
    /**
     * @var array the options for the Bootstrap ColorPicker plugin.
     * Please refer to the Bootstrap ColorPicker plugin Web page for possible options.
     * @see https://itsjavi.com/bootstrap-colorpicker/index.html
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the underlying Bootstrap ColorPicker plugin.
     * Please refer to the [ColorPicker](https://itsjavi.com/bootstrap-colorpicker/index.html) plugin
     * Web page for possible events.
     */
    public $clientEvents = [];

    /**
     * @var array HTML attributes to render on the container
     */
    public $containerOptions = [];

    /**
     * @var string the addon markup if you wish to display the input as a component. If you don't wish to render as a
     * component then set it to null or false.
     */
    public $addon = '<i></i>';
    /**
     * @var string the template to render the input.
     */
    public $template = '{input}{addon}';
    /**
     * @var bool whether to render the input as an inline color picker
     */
    public $inline = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->inline) {
            $this->options['readonly'] = 'readonly';
            Html::addCssClass($this->options, 'text-center');
        }

        Html::addCssClass($this->options, 'form-control');
        Html::addCssClass($this->containerOptions, 'input-group colorpicker-component');
    }

    /**
     * @inheritdoc
     */
    public function run()
    {

        $input = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);

        if ($this->inline) {
            $input .= '<div></div>';
        }
        if ($this->addon && !$this->inline) {
            $addon = Html::tag('span', $this->addon, ['class' => 'input-group-addon']);
            $input = strtr($this->template, ['{input}' => $input, '{addon}' => $addon]);
            $input = Html::tag('div', $input, $this->containerOptions);
        }
        if ($this->inline) {
            $input = strtr($this->template, ['{input}' => $input, '{addon}' => '']);
        }
        echo $input;

        $this->registerClientScript();
    }

    /**
     * Registers required script for the plugin to work as ColorPicker
     */
    public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        ColorPickerAsset::register($view);

        $id = $this->options['id'];
        $selector = ";jQuery('#$id')";

        if ($this->addon || $this->inline) {
            $selector .= ".parent()";
        }

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        $js[] = "$selector.colorpicker($options);";

        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "$selector.on('$event', $handler);";
            }
        }
        $view->registerJs(implode("\n", $js));
    }

}