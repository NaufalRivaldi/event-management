<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function getRecord()
    {
        return Event::active()->get();
    }

    public function getEventIncomming()
    {
        $dateNow = date('Y-m-d');

        return Event::active()
            ->where('end_date', '>=', $dateNow)
            ->orderBy('start_date', 'ASC')
            ->get();
    }
}