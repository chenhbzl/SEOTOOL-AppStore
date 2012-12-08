<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $this AppCodeController */
/* @var $model AppCode */
?>
<div class="item_image float">
    <?php echo CHtml::image($model->getAttribute('app_icon'), 'app icon', array('class' => 'app_icon')); ?>
</div>
<div class="item_app float">
    <ul>
        <li>
            <?php echo CHtml::link($model->getAttribute('app_name'), array('appCode/competeKeyword', 'id' => $model->app_id)) ?>
        </li>
        <li>
            <?php echo CHtml::link($model->getAttribute('artist_name'), $model->getAttribute('artist_url'), array('target' => 'blank')) ?>
        </li>
        <li>
            <?php
            $this->renderPartial('common/_star', array(
                'model' => $model,
            ))
            ?>

        </li>
    </ul>
</div>
<div class="item_info float">
    <ul>
        <li><?php echo CHtml::encode($model->getAttributeLabel('price')); ?>
            <?php echo CHtml::encode($model->getAttribute('price')) ?>
        </li>
        <li><?php echo CHtml::encode($model->getAttributeLabel('current_version')) ?>
            <?php echo CHtml::encode($model->getAttribute('current_version')) ?>
        </li>
        <li><?php echo CHtml::encode($model->getAttributeLabel('version_update_date')) ?>
            <?php echo CHtml::encode($model->getAttribute('version_update_date')) ?>
        </li>
        <li><?php echo CHtml::encode($model->getAttributeLabel('all_category')) ?>
            <?php echo CHtml::encode($model->getAttribute('all_category')) ?>
        </li>
    </ul>
</div>
<div class="summary float">
    <div class="label description">Description</div>
    <div class="info float">
        <p>
            <?php echo CHtml::encode($model->getAttribute('summary')) ?>
        </p>
    </div>
</div>