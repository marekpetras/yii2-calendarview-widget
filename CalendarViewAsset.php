<?php

namespace marekpetras\calendarview;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the css/js files for the [[Calendar]] widget.
 *
 * @author Marek Petras
 */
class CalendarViewAsset extends AssetBundle
{
    public $sourcePath = '@vendor/marekpetras/yii2-calendarview/assets';
    public $js = [
        'marekpetras.calendar.js',
    ];
    public $css = [
        'marekpetras.calendar.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
