<?php

/**
 * @author Marek Petras <mark@markpetras.eu>
 * @link https://github.com/marekpetras/yii2-calendar/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0.0
 */

namespace marekpetras\calendarview;

use \DateTime;
use \DateInterval;

/**
 * CalendarViewDateTime
 *
 * provides traversable object
 */
class CalendarViewDateTime extends DateTime
{
    private $interval;
    public $intervalString = 'P1D';

    public function __construct($time, $timezone=null)
    {
        parent::__construct($time, $timezone);

        $this->interval = new \DateInterval($this->intervalString);
    }

    public function format($format)
    {
        if ( $format == 'w' ) {
            return parent::format('w') == 0 ? 7 : parent::format('w');
        }
        else {
            return parent::format($format);
        }
    }

    public function date()
    {
        return $this->format('Y-m-d');
    }

    public function next()
    {
        $this->add($this->interval);
    }

    public function prev()
    {
        $this->sub($this->interval);
    }
}