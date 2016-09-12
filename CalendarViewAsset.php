<?php

/**
 * @author Marek Petras <mark@markpetras.eu>
 * @link https://github.com/marekpetras/yii2-calendarview-widget
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0.1
 */

namespace marekpetras\calendarview;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the css/js files for the [[Calendar]] widget.
 */
class CalendarViewAsset extends AssetBundle
{
    public $sourcePath = '@vendor/marekpetras/yii2-calendarview-widget/assets';
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
