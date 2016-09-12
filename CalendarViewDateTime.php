<?php

/**
 * @author Marek Petras <mark@markpetras.eu>
 * @link https://github.com/marekpetras/yii2-calendarview-widget
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0.1
 */

namespace marekpetras\calendarview;

use DateTime;
use DateInterval;

/**
 * CalendarViewDateTime
 *
 * provides traversable object
 */
class CalendarViewDateTime extends DateTime
{
    private $interval;
    private $intervalString = 'P1D';

    /**
     * __construct
     *
     * @param $time readable by DateTime
     * @param str timezone readable by DateTime e.g. Australia/Sydney
     * @return void
     */
    public function __construct($time, $timezone=null)
    {
        parent::__construct($time, $timezone);

        $this->interval = new DateInterval($this->intervalString);
    }

    /**
     * simplified formatter, overrides parent, changes 0 to 7 on weekday for sunday
     *
     * @param str $format
     * @return str formatted date
     */
    public function format($format)
    {
        if ( $format == 'w' ) {
            return parent::format('w') == 0 ? 7 : parent::format('w');
        }
        else {
            return parent::format($format);
        }
    }

    /**
     * retrieve default date
     *
     * @return str current date formatted to Y-m-d
     */
    public function date()
    {
        return $this->format('Y-m-d');
    }

    /**
     * advance date by interval
     *
     * @return void
     */
    public function next()
    {
        $this->add($this->interval);
    }

    /**
     * substract date by interval
     *
     * @return void
     */
    public function prev()
    {
        $this->sub($this->interval);
    }
}