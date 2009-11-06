<?php
class DateTimeUtility {
    // Gets the precise date and time, including milliseconds
    static function getPreciseTime()
    {   
        $m = explode(' ',microtime());
        return array($m[1], (int)round($m[0]*1000,3));
    }
}

?>