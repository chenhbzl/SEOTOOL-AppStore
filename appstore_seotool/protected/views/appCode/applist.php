<?php
/* @var $this AppCodeController */
/* @var $item AppCode */
$this->breadcrumbs = array(
    'App List',
);
?>
<?php
$this->widget('application.extensions.jui.EJqueryUiInclude', array('theme' => 'humanity'));
?>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/js/javascript.js"></script>

<div class="wrap_content">
    <div class="content">
        <div class="country">
            <?php
            $country = CountryCode::allCountry();
            $country[0] = 'all';
            echo CHtml::dropDownList('select_country', '0', $country);
            ?>
        </div>
        <?php foreach ($appCodes as $item): ?>
            <div class="item country_<?php echo $item->country_id ?>">
                <div class="item_image float">
                    <?php echo CHtml::image($item->getAttribute('app_icon'), 'app icon', array('class' => 'app_icon')); ?>
                </div>
                <div class="item_app float">
                    <ul>
                        <li>
                            <?php echo CHtml::link($item->getAttribute('app_name'), array('appCode/competeKeyword', 'id' => $item->app_id)) ?>
                        </li>
                        <li>
                            <?php echo CHtml::link($item->getAttribute('artist_name'), $item->getAttribute('artist_url'), array('target' => 'blank')) ?>
                        </li>
                        <li>
                            <?php
                            $this->renderPartial('common/_star', array(
                                'model' => $item,
                            ))
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="item_info float">
                    <ul>
                        <li><?php echo CHtml::encode($item->getAttributeLabel('price')); ?>
                            <?php echo CHtml::encode($item->getAttribute('price')) ?>
                        </li>
                        <li><?php echo CHtml::encode($item->getAttributeLabel('current_version')) ?>
                            <?php echo CHtml::encode($item->getAttribute('current_version')) ?>
                        </li>
                        <li><?php echo CHtml::encode($item->getAttributeLabel('version_update_date')) ?>
                            <?php echo CHtml::encode($item->getAttribute('version_update_date')) ?>
                        </li>
                        <li><?php echo CHtml::encode($item->getAttributeLabel('all_category')) ?>
                            <?php echo CHtml::encode($item->getAttribute('all_category')) ?>
                        </li>
                    </ul>
                </div>


                <div class="clear"></div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<div class="clear"></div>



