<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class = "rating" id = "10_4">
    <?php
    $star = $model->rating;
    $star = floatval($star);
    $full = intval($star);
    $half = $star - $full;
    if ($half >= 0.8) {
        $full += 1;
        $half = 0;
    } elseif ($half > 0.3 && $half < 0.8) {
        $half = 1;
    }
    $blank = 5 - $full - $half;
    for ($i = 0; $i < $full; $i++) {
        echo "<img src='".Yii::app()->request->baseUrl."/css/images/star_full.png' />";
    }
    if ($half)
        echo "<img src='".Yii::app()->request->baseUrl."/css/images/star_half.png' />";

    for ($i = 0; $i < $blank; $i++) {
        echo "<img src='".Yii::app()->request->baseUrl."/css/images/star_blank.png' />";
    }
    ?>
    <p class="rating"><?php echo CHtml::encode($model->rating) ?></p>
    <p class="rating_count">(<?php echo CHtml::encode($model->rating_count); ?>)</p>

</div>
