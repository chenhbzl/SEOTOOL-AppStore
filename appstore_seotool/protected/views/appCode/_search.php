<?php
/* @var $this AppCodeController */
/* @var $model AppCode */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'app_id'); ?>
		<?php echo $form->textField($model,'app_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'package_id'); ?>
		<?php echo $form->textField($model,'package_id',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_name'); ?>
		<?php echo $form->textField($model,'app_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'all_category'); ?>
		<?php echo $form->textField($model,'all_category',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_specify_flag'); ?>
		<?php echo $form->textField($model,'app_specify_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'artist_url'); ?>
		<?php echo $form->textArea($model,'artist_url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'artist_name'); ?>
		<?php echo $form->textField($model,'artist_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_version'); ?>
		<?php echo $form->textField($model,'current_version',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'version_update_date'); ?>
		<?php echo $form->textField($model,'version_update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'require_android'); ?>
		<?php echo $form->textField($model,'require_android',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'insert_date'); ?>
		<?php echo $form->textField($model,'insert_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'delete_date'); ?>
		<?php echo $form->textField($model,'delete_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'delete_flag'); ?>
		<?php echo $form->textField($model,'delete_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'display_flag'); ?>
		<?php echo $form->textField($model,'display_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_icon'); ?>
		<?php echo $form->textField($model,'app_icon',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot1'); ?>
		<?php echo $form->textField($model,'screenshot1',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot2'); ?>
		<?php echo $form->textField($model,'screenshot2',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot3'); ?>
		<?php echo $form->textField($model,'screenshot3',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot4'); ?>
		<?php echo $form->textField($model,'screenshot4',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot5'); ?>
		<?php echo $form->textField($model,'screenshot5',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot6'); ?>
		<?php echo $form->textField($model,'screenshot6',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot7'); ?>
		<?php echo $form->textField($model,'screenshot7',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'screenshot8'); ?>
		<?php echo $form->textField($model,'screenshot8',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->