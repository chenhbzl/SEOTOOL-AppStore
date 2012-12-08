<?php
/* @var $this KeywordCodeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Keyword Codes',
);

$this->menu=array(
	array('label'=>'Create KeywordCode', 'url'=>array('create')),
	array('label'=>'Manage KeywordCode', 'url'=>array('admin')),
);
?>

<h1>Keywords</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
