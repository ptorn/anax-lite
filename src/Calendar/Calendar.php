<?php
namespace Peto16\Calendar;

use \Peto16\Calendar\Month as Month;

class Calendar
{
    private $weekDays = ["Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag", "Söndag"];
    private $months = ["Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December"];
    private $today = [];
    public $month;
    public $year;
    private $monthObj;
    public $previousMonthObj;
    public $nextMonthObj;



    /**
     * Constructor for Calendar.
     * @method __construct
     */
    public function __construct()
    {
        $this->today = getdate();
        $this->month = $this->today["mon"];
        $this->year = $this->today["year"];
    }



    /**
     * Method to load in the data for the calendar
     * @method load
     * @param  boolean $year  [Give a year or default will be false]
     * @param  boolean $month [Give a month or default will be false]
     * @return void
     */
    public function load($year = false, $month = false)
    {
        // Set month and year for the calendar.
        $this->year = $year ? $year : $this->today["year"];
        $this->month = $month ? $month : $this->today["mon"];
        $this->monthObj = new Month($this->year, $this->month);
        $this->previousMonthObj = $this->getPreviousMonthObj();
        $this->nextMonthObj = $this->getNextMonthObj();
    }



    /**
     * Generate an array of table objects for the month.
     * @method generateCalendar
     * @return Array           [All days of the month]
     */
    private function generateCalendar()
    {
        $daysArray = [];

        // Add days to the returning daysArray from previous month.
        for ($x = $this->monthObj->firstDayOfMonth - 1; $x > 0; $x--) {
            array_push($daysArray, "<td class=\"grey\">" . ($this->previousMonthObj->nrDays - $x + 1) . "</td>");
        }

        // Add days from current month to daysArray.
        for ($x = 1; $x <= $this->monthObj->nrDays; $x++) {
            if ($x == $this->today["mday"] && $this->monthObj->month == $this->today["mon"]) {
                $data = "<td class=\"today\">" . $x . "</td>";
            } else {
                $data = "<td>" . $x . "</td>";
            }
            array_push($daysArray, $data);
        }
        return $daysArray;
    }



    /**
     * Generates a HTML table to output the calendar.
     * @method outputHtmlTable
     * @return string          [HTML table]
     */
    public function outputHtmlTable()
    {
        $daysArray = $this->generateCalendar();
        $output = "<div class=\"calendar-image\"><img src=\"image/calendar/" . $this->month . ".jpg?w=640\"></div>";
        $output .= "<div class=\"calendar\"><table class=\"calendar-table\"><tr>";
        $output .= "<th class=\"week\">Vecka</th>";
        for ($x = 0; $x < count($this->weekDays); $x++) {
            $output .= "<th>" . $this->weekDays[$x] . "</th>";
        }
        $output .= "</tr>";
        $counter = 0;
        $parentMonth = 1; // Startnr for parent month.
        $weekNr = $this->monthObj->firstWeekNr;
        $checkLoop = true; // Used to stop adding weeks.
        while ($checkLoop) {
            $output .= "<tr><td class=\"calendar-week\">" . (int)$weekNr . "</td>";
            for ($i = 0; $i < 7; $i++) {
                if ($counter < count($daysArray)) {
                    $dayNr = $daysArray[$counter];
                } else {
                    $dayNr = "<td class=\"grey\">" . $parentMonth . "</td>";
                    $parentMonth++;
                }
                if ($i === 6) {
                    $redDay = str_replace("<td>", "<td class=\"red\">", $dayNr);
                    $output .= $redDay;
                } else {
                    $output .= $dayNr;
                }

                $counter++;
                // Stop generating weeks when array is done.
                if ($counter == count($daysArray)) {
                    $checkLoop = false;
                }
            }
            $weekNr++;
            $weekNr = $weekNr == 53 ? 1 : $weekNr;
            $output .= "</tr>";
        }
        $output .= "</table></div>";
        return $output;
    }



    /**
     * Get the title of the calendar in "month year"
     * @method getCalendarTitle
     * @return string           ["month year"]
     */
    public function getCalendarTitle()
    {
        return $this->months[$this->month - 1] . " " . $this->year;
    }



    /**
     * Create and return a month object of previous month.
     * @method getPreviousMonthObj
     * @return Month              [Month object of previous month]
     */
    public function getPreviousMonthObj()
    {
        if ($this->month == 1) {
            return new Month($this->year - 1, 12);
        } else {
            return new Month($this->year, $this->month - 1);
        }
    }



    /**
     * Create and return a month object of next month.
     * @method getNextMonthObj
     * @return Month          [Month object of next month]
     */
    public function getNextMonthObj()
    {
        if ($this->month == 12) {
            return new Month($this->year + 1, 1);
        } else {
            return new Month($this->year, $this->month + 1);
        }
    }
}
