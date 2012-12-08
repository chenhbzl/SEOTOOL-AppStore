<?php
/* @var $this KeywordCodeController */
/* @var $model KeywordCode */

$this->breadcrumbs=array(
	'Keyword Codes'=>array('index'),
	$model->keyword_id,
);

$this->menu=array(
	array('label'=>'List KeywordCode', 'url'=>array('index')),
	array('label'=>'Create KeywordCode', 'url'=>array('create')),
	array('label'=>'Update KeywordCode', 'url'=>array('update', 'id'=>$model->keyword_id)),
	array('label'=>'Delete KeywordCode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->keyword_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KeywordCode', 'url'=>array('admin')),
);
?>

<h1>View KeywordCode #<?php echo $model->keyword_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'keyword_id',
		'keyword',
		'keyword_specify_flag',
		'insert_date',
		'update_date',
		'delete_date',
		'delete_flag',
	),
)); ?>
