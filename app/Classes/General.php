<?php
namespace App\Classes;

use Illuminate\Support\Carbon;
class General {
    public function __construct()
    {
        return true;
    }

    public function shortTime($e)
    {
        $date = date_create($e);
        // Datetime current
        $now = Carbon::now();
        // two date difference
        $diff=date_diff($date,$now);
        $y = $diff->format('%y');
        $m = $diff->format('%m');
        $d = $diff->format('%d');
        $h = $diff->format('%h');
        $i = $diff->format('%i');
        if ($y > 0) {
            return $y.' '.__('year ago');
        } else if ($m > 0) {
            return $m.' '.__('month ago');
        } else if ($d > 0) {
            return $d.' '.__('day ago');
        } else if ($h > 0) {
            return $h.' '.__('hour ago');
        } else if ($i > 0) {
            return $i.' '.__('minute ago');
        } else {
            return __('Just now');
        }
    }
}