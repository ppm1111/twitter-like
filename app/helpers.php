<?php

use Carbon\Carbon;

if (! function_exists('formatDatetime')) {
    function formatDate($datetime)
    {
        return Carbon::create($datetime)->format('Y-m-d H:i:s');
    }
}