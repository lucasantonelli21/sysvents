<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {

    function formatDate($date, $type) {
        $newDate = new Carbon($date);
        return $newDate->format($type);  // Retorna a data formatada como string
    }
}

// $teste = new Carbon();

// $event->start_date = new Carbon($event->start_date);

// dd($event, $teste->format("d/m/Y H:m:s"));