<?php
/* @var $this KeywordCodeController */
/* @var $model KeywordCode */

$this->breadcrumbs=array(
	'Keyword Codes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KeywordCode', 'url'=>array('index')),
	array('label'=>'Manage KeywordCode', 'url'=>array('admin')),
);
?>

<h1>Create KeywordCode</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>