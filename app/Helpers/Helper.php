<?php

namespace App\Helpers;
use Carbon\Carbon;

class Helper 
{
    protected static $start_time = '';

    public static function checkEndDate($date){
        $date1 = Carbon::createFromFormat('Y-m-d H:i:s',$date);
        $date2 = Carbon::now();
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s',$date2);
        $result = $date1->gt($date2);
        return $result;
    }

    public static function checkStartDate($date){
        self::$start_time = $date;
        $date1 = Carbon::createFromFormat('Y-m-d H:i:s',$date);
        $date2 = Carbon::now();
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s',$date2);
        $result = $date1->lt($date2);
        return $result;
    }

    public static function getStartDate(){
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s',self::$start_time);
        return $date_time;
    }

    
}