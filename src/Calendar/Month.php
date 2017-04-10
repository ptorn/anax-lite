<?php
namespace Peto16\Calendar;

class Month
{
    public $nrDays;
    public $year;
    public $month;
    public $weekNrArray = [];
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
        $this->weekNrs();
        $this->firstDayOfMonth = date('w', strtotime($this->year . "-" . $this->month . "-01"));
    }



    /**
     * Returns an array with week numbers for the month.
     * @method weekNrs
     * @return array  [week numbers]
     */
    private function weekNrs()
    {
        // Add weeknr to the weeknrarray.
        $week = date('W', strtotime($this->year . "-" . $this->month . "-01"));
        for ($x = 0; $x < 5; $x++) {
            array_push($this->weekNrArray, $week + $x);
        }
    }
}
