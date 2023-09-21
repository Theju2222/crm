<?php
class Time1 extends Database {
    private $dbConnect = false;

    public function __construct() {
        $this->dbConnect = $this->dbConnect();
        date_default_timezone_set('Africa/Lusaka');
    }

    public function ago($time) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        $now = time();
        $difference = $now - $time;
        $tense = 'ago';

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        
        if ($difference != 1) {
            $periods[$j] .= "s";
        }
        $date = date("d-m-Y", $time);
        $time = date("H:i:s", $time);

        return  $date;
    }
}
