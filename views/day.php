<?php

use yii\helpers\Html;
use yii\helpers\Url;

$classes = [];

if ( $models ) {
    $classes[] = 'activity';
}
else {
    $classes[] = 'inactivity';
}

if ( $date->format('Ymd') == date('Ymd') ) {
    $classes[] = 'today';
}

?>

<td <?=count($classes)?'class="'.implode(' ',$classes).'"':''?>>
    <div class="day-box">
        <div class="date-box"><?=$date->format('j')?></div>
        <div class="model-box">
            <?=$dayRender?>
        </div>
    </div>
</td>