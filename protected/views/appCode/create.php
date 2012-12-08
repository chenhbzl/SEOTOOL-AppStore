<?php
/* @var $this AppCodeController */
/* @var $model AppCode */

$this->breadcrumbs=array(
	'App Codes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AppCode', 'url'=>array('index')),
	array('label'=>'Manage AppCode', 'url'=>array('admin')),
);
?>

<h1>Create AppCode</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>