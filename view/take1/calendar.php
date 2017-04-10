<?php

$year = isset($_GET["year"]) ? $_GET["year"] : false;
$month = isset($_GET["month"]) ? $_GET["month"] : false;
$calendar->load($year, $month);

$previousMonth = $calendar->previousMonthObj->month;
$previousYear = $calendar->previousMonthObj->year;
$nextMonth = $calendar->nextMonthObj->month;
$nextYear = $calendar->nextMonthObj->year;

?>
<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h2><?= $calendar->getCalendarTitle(); ?></h1>
                    <div class="calendar-navigation">
                        <div class="calendar-previous"><a href="?year=<?= $previousYear ?>&month=<?= $previousMonth ?>">Föregående</a></div>
                        <div class="calendar-next"><a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>">Nästa</a></div>
                    </div>
                <?= $calendar->outputHtmlTable(); ?>
            </main>
        </div>
    </div>
</div>
