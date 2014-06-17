<?php
/* @var $this DatoController */
/* @var $model Dato */

$this->breadcrumbs=array(
	'Datos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dato', 'url'=>array('index')),
	array('label'=>'Manage Dato', 'url'=>array('admin')),
);
?>

<h1>Enviar Dato</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>