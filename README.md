Bootstrap ColorPicker Widget for Yii2
====================================

Renders a [Bootstrap ColorPicker plugin](https://github.com/itsjavi/bootstrap-colorpicker/).

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require zgb7mtr/yii2-bootstrap-color-picker:~1.0
```
or add

```json
"zgb7mtr/yii2-bootstrap-color-picker" : "~1.0"
```

to the require section of your application's `composer.json` file.

Usage
-----

This widget renders a Bootstrap ColorPicker input control. Best suitable for model with date string attribute.

***Example of use with a form***  
There are two ways of using it, with an `ActiveForm` instance or as a widget setting up its `model` and `attribute`.

```
<?php
use zgb7mtr\colorPicker\ColorPicker;

// as a widget
?>

<?= ColorPicker::widget([
    'model' => $model,
    'attribute' => 'color',
]);?>

<?php 
// with an ActiveForm instance 
?>
<?= $form->field($model, 'color')->widget(
    ColorPicker::className());?>
```  
***Example of use without a model***

```  
<?php
use zgb7mtr\colorPicker\ColorPicker;
?>
<?= ColorPicker::widget([
    'name' => 'Test',
    'value' => '#CCCCCC'
]);?>
```