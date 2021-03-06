<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $this AppCodeController */
/* @var $model AppCode */
?>
<?php
$this->widget('application.extensions.jui.EJqueryUiInclude', array('theme' => 'humanity'));
Yii::app()->clientScript->registerScriptFile('http://www.google.com/jsapi');
?>

<?php
$this->breadcrumbs = array(
    'App List' => array('appCode/appList'),
    'Compete Keyword',
    'Compete App',
);
//load appinfo
$this->renderPartial('_appinfo', array(
    'model' => $model
));
?>
<div class="selection float">
    <div class="country float">
        <?php
        echo CHtml::encode($model->countryCode->getAttributeLabel('country_name'));
        echo ":";
        echo CHtml::encode($model->countryCode->getAttribute('country_name'));
        ?>
    </div>

    <div class="date float">
        Date:<input type="text" id="startdate" readonly="readonly"
                    value="<?php echo date('Y-m-d', time() - 2592000); ?>" /> ~
    </div>
    <div class="date float">
        <input type="text" id="enddate" readonly="readonly"
               value="<?php echo date('Y-m-d', time()); ?>" />
    </div>
</div>

<!-- start graphic -->
<div class="clear"></div>
<div id="graphic" style="height: 250px; border: #e3e3e3 1px solid; margin-top: 20px;"></div>

<div class="clear"></div>
<!-- end graphic -->

<!--Table -->
<?php $this->beginWidget('application.extensions.jui.ETabs', array('name' => 'statistics')); ?>
<?php $this->beginWidget('application.extensions.jui.ETab', array('name' => 'tab_summary', 'title' => 'Summary')); ?>
<div id="summary_app_table1"></div>
<div class="clear"></div>
<p>Bookmark keyword</p>
<div id="summary_app_table2"></div>
<?php $this->endWidget('application.extensions.jui.ETab'); ?>

<?php $this->beginWidget('application.extensions.jui.ETab', array('name' => 'tab_detail', 'title' => 'Detail')); ?>
<div id="detail_app_table1"></div>
<div class="clear"></div>
<p>Bookmark keyword</p>
<div id="detail_app_table2"></div>
<?php $this->endWidget('application.extensions.jui.ETab'); ?>
<?php $this->endWidget('application.extensions.jui.ETabs') ?>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/js/competeapp.js"></script>