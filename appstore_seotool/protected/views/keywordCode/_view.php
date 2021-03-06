<?php
/* @var $this KeywordCodeController */
/* @var $data KeywordCode */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->keyword_id), array('view', 'id'=>$data->keyword_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword')); ?>:</b>
	<?php echo CHtml::encode($data->keyword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword_specify_flag')); ?>:</b>
	<?php echo CHtml::encode($data->keyword_specify_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insert_date')); ?>:</b>
	<?php echo CHtml::encode($data->insert_date); ?>
	<br />

</div>