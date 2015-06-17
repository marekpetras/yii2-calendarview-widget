<?php

/**
 * calendar widget
 *
 * @author Marek Petras <mark@markpetras.eu>
 * @link https://github.com/marekpetras/yii2-calendar/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0.0
 */

namespace marekpetras\calendarview;

use marekpetras\calendarview\CalendarViewAsset;
use marekpetras\calendarview\CalendarViewDateTime;

use app\helpers\DateHelper;
use yii\helpers\VarDumper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\View;
use yii\web\JsExpression;
use yii\web\AssetBundle;
use \Closure;

class CalendarView extends \yii\base\Widget
{
    /**
     * @var \yii\data\DataProviderInterface the data provider for the view. This property is required.
     */
    public $dataProvider;

    /**
     * @var which field to take as a value for the date (to display in the calendar)
     */
    public $valueField;

    /**
     * @var which field to take as a datefield
     */
    public $dateField;

    public $weekStart = 1; // date('w')

    public $title = 'Calendar';
    public $link = false;
    public $dayRender = false;

    // defined views
    public $views = [
        'calendar' => '@marekpetras/calendarview/views/calendar',
        'month' => '@marekpetras/calendarview/views/month',
        'day' => '@marekpetras/calendarview/views/day',
    ];

    // local
    private $models = [];
    private $calendarFormat = 'Y-m-d';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAssets();

        // load all models
        $this->dataProvider->pagination->pageSize = 0;
        $this->dataProvider->setSort(['attributes'=>[$this->dateField]]);

        foreach ( $this->dataProvider->getModels() as $model ) {
            $this->models[date($this->calendarFormat,strtotime($model->{$this->dateField}))][] = $model;
        }

        $html = $this->renderCalendar();

        return $html;
    }

    /**
     * Registers required assets and the executing code block with the view
     * @return void
     */
    protected function registerAssets()
    {
        CalendarViewAsset::register($this->getView());

        $key = __CLASS__ . '#' . $this->id;
        $js = "$('#".$this->id."').calendar();";
        $this->view->registerJs($js, View::POS_LOAD, $key);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ( !$this->dataProvider instanceof \yii\data\DataProviderInterface ) {
            throw new InvalidConfigException('Invalid data provider');
        }

        parent::init();
    }

    /**
     * Renders the calendar
     * @return string the rendering result
     */
    protected function renderCalendar()
    {
        $calendar = '';

        foreach ( range(2014,2015) as $year ) {
            foreach ( range(1,12) as $month ) {
                $calendar .= $this->renderMonth($month, $year);
            }
        }

        return $this->view->render($this->views['calendar'],[
            'calendar' => $calendar,
            'title' => $this->title,
            'id' => $this->id,
        ]);
    }

    /**
     * Renders a calendar month with models from the data provider
     * @param integer $month month for which to be rendered
     * @param integer $year year for which to be rendered
     * @return string the rendering result
     */
    protected function renderMonth($month = null, $year = null)
    {
        // set current ones if none passed
        if ( !$month ) {
            $month = date('m');
        }

        if ( !$year ) {
            $year = date('Y');
        }

        // set range for this month
        $first = new CalendarViewDateTime($year.'-'.$month.'-1');
        $last = new CalendarViewDateTime($first->format('Y-m-t'));

        $start = true;

        // create a modelable instance
        $current = clone $first;

        // store html
        $html = '';
        $html .= Html::beginTag('tr');

        while ($current <= $last)
        {
            // render week column
            if ( $current->format('w') == 1 ) {
                $html .= Html::beginTag('tr');
                $html .= Html::tag('td',Html::tag('div',$current->format('W')),['class'=>'week-number']);
            }

            // render days
            if ( $start && $current->format('w') != 1 ) {
                $html .= Html::tag('td',Html::tag('div',$current->format('W')),['class'=>'week-number']);

                $days = ($current->format('w')-2);

                foreach (range(0,$days) as $day ) {
                    $html .= Html::tag('td');
                }
                $start = false;
            }
            else {
                $start = false;
            }

            // fill in model data
            $models = array_key_exists($current->date(), (array) $this->models) ? $this->models[$current->date()] : [];
            $dayRender = '';
            foreach ( $models as $model ) {

                if ($this->dayRender instanceof Closure) {
                    $dayRender .= call_user_func($this->dayRender, $model, $this);
                }
                else {
                    $text = $model->{$this->valueField};
                    $link = null;

                    if ( $this->link instanceof Closure ) {
                        $link = call_user_func($this->link, $model, $this);
                    }

                    $dayRender .= Html::tag('p',Html::a($text,$link),['class'=>''/*'btn btn-info'*/]);
                }

            }

            $html .= $this->view->render($this->views['day'],[
                'models' => $models,
                'valueField' => $this->valueField,
                'date' => $current,
                'link' => $this->link,
                'dayRender' => $dayRender,

            ]);

            // new row after each week
            if ( $current->format('w') == 7 ) {
                $html .= Html::endTag('tr');
            }

            // move to next day
            $current->next();
        }

        return $this->view->render($this->views['month'],[
            'title' => $first->format('F Y'),
            'content' => $html,
            'monthRendered' => $first->format('Y')*12+$first->format('m'),
        ]);
    }
}