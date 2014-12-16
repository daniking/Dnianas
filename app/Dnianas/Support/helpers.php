<?php 

function formatDate($date) {
    $dt = Carbon::parse($date);
    return $dt->timestamp;
}
