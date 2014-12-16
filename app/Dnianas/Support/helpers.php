<?php 

function formatDate($date) {
    return Carbon::parse($date)->timestamp;
}
