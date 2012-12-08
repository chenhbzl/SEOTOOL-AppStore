<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="view">
    <?php $keywordCodes = $model->keywordCodes?>
    <?php foreach ($keywordCodes as $keywordCode): ?>  
        <b><?php echo CHtml::encode($keywordCode->getAttributeLabel('keyword')); ?>:</b>
	<?php echo CHtml::encode($keywordCode->keyword); ?>
	<br />
    <?php endforeach; ?>



</div>