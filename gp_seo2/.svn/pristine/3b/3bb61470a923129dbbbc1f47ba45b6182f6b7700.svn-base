<?php
/* @var $this AppCodeController */
/* @var $model AppCode */

$this->breadcrumbs=array(
	'App Codes'=>array('index'),
	$model->app_id,
);

$this->menu=array(
	array('label'=>'List AppCode', 'url'=>array('index')),
	array('label'=>'Create AppCode', 'url'=>array('create')),
	array('label'=>'Update AppCode', 'url'=>array('update', 'id'=>$model->app_id)),
	array('label'=>'Delete AppCode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->app_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppCode', 'url'=>array('admin')),
);
?>

<h1>View AppCode #<?php echo $model->app_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'app_id',
		'package_id',
		'app_name',
		'country_id',
		'summary',
		
		
	),
)); ?>
<div id="keywordCode">
    <h3>keyword </h3>
    <?php $this->renderPartial('_keywordCodes', array(
        'model' => $model
    ))?>
    <h3>insert a keyword</h3>
 
    <?php if(Yii::app()->user->hasFlash('keywordCodeSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('keywordCodeSubmitted'); ?>
        </div>
    <?php else: ?>
        <?php $this->renderPartial('/keywordCode/_form',array(
            'model'=>$keywordCode,
        )); ?>
    <?php endif; ?>
 
</div>