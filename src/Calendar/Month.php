<?php
namespace Peto16\Calendar;

class Month
{
    public $nrDays;
    public $year;
    public $month;
    public $firstWeekNr;
    public $firstDayOfMonth;



    /**
     * Constructor for month.
     * @method __construct
     * @param  integer      $year  [value for year]
     * @param  integer      $month [value for month]
     */
    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
        $this->nrDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->firstWeekNr = date('W', strtotime($this->year . "-" . $this->month . "-01"));
        $this->firstDayOfMonth = date('w', strtotime($this->year . "-" . $this->month . "-01"));
    }
}
