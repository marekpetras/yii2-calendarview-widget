<?php

namespace marekpetras\calendarview;

use \DateTime;
use \DateInterval;

class CalendarViewDateTime extends DateTime
{
    private $interval;

    public function __construct($time, $timezone=null)
    {
        parent::__construct($time, $timezone);

        $this->interval = new \DateInterval('P1D');
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