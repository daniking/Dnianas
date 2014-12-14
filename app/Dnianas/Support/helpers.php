<?php 

function formatDate($date) {
    $dt = Carbon::parse($date);
    return Carbon::create($dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute)->diffForHumans();
}
