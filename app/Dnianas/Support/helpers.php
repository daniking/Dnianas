<?php 

function format_date($date) {
    return Carbon::parse($date)->timestamp;
}
