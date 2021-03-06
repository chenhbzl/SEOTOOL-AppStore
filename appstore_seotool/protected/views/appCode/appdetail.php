<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $this AppCodeController */
/* @var $model AppCode */
?>
<?php
$this->breadcrumbs = array(
    'App List' => array('appCode/appList'),
    'Compete Keyword',
    'Compete App',
    'App Detail',
);
?>

<div class="label float">App Info</div>
<div class="clear"></div>
<div class="app_info float">
    <div class="main_info float">        
        <div class="info float">
            <div class="image float">
                <?php echo CHtml::image($model->getAttribute('app_icon')); ?>
                <p><?php echo CHtml::encode($model->categoryCode->getAttribute('category_name')) ?></p>
            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->countryCode->getAttributeLabel('country_name')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->countryCode->getAttribute('country_name')) ?></div>
            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('app_name')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('app_name')) ?></div>
            </div>
            <div class="info_item float" id="summary">
                <p><?php echo CHtml::encode($model->getAttribute('summary')) ?></p>
            </div>
        </div>
        <div class="detail_info float">
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('rating')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('rating')) ?></div>
            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('update_date')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('update_date')) ?></div>
            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('current_version')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('current_version')) ?></div>
            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('require_android')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('require_android')) ?></div>

            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->categoryCode->getAttributeLabel('category_name')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->categoryCode->getAttribute('category_name')) ?></div>

            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('size')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('size')) ?></div>
            </div>
            <div class="info_item float">
                <div class="float"><?php echo CHtml::encode($model->getAttributeLabel('price')) ?></div>
                <div class="float"><?php echo CHtml::encode($model->getAttribute('price')) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
<div class="screenshot">
    <div class="label">Screenshot</div>
    <div class="clear"></div>
    <div class="main_screenshot">
        <div id="slider1" class="slider">
            <ul>
                <li>
                    <div class="sider_item"><?php echo CHtml::image($model->screenshot1) ?></div>
                </li>
                <li>
                    <div class="sider_item"><?php echo CHtml::image($model->screenshot2) ?></div>
                </li>	
                <li>
                    <div class="sider_item"><?php echo CHtml::image($model->screenshot3) ?></div>
                </li>
                <li>
                    <div class="sider_item"><?php echo CHtml::image($model->screenshot4) ?></div>
                </li>
                <li>
                    <div class="sider_item"><?php echo CHtml::image($model->screenshot5) ?></div>
                </li>
            </ul>
        </div>

    </div>
</div>

<?php Yii::app()->clientScript->registerScript('script', <<<JS
    var len = 500;
    var summary = $("#summary").text();
    if(summary.length > len)
    {
        var shortSum = summary.substr(0, len);
    
        $('#summary').html(shortSum + "<br /><a id='more'>More...</a>");
    
        $("#more").click(function(){
            $("#summary").html(summary);
        });
       
    
    }
JS
, CClientScript::POS_READY);?>
