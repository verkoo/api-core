<?php

namespace Verkoo\Common\Services;

use Carbon\Carbon;
use Verkoo\Common\Contracts\CalendarInterface;
use Spatie\GoogleCalendar\Event;

class GoogleCalendar implements CalendarInterface
{
    public function getEvents($events = null)
    {
        $events = $events ?: Event::get();

        $result = [];

        $events->each(function($event) use (&$result) {
            $start = Carbon::parse($event->start->date);
            $end = Carbon::parse($event->end->date);
            $length = $end->diffInDays($start);

            for ($i = 0; $i < $length; $i++) {
                if (!isset($result[$start->toDateString()])) {
                    $result[$start->toDateString()] = [];
                }

                array_push(
                    $result[$start->toDateString()],
                    ['title' => $event->summary]
                );
                $start->addDay();
            }
        });

        return $result;
    }

    public function store($data)
    {
        $event = new Event;
        $event->name = $data['title'];
        $event->startDate = Carbon::createFromFormat('d/m/Y', $data['start']);
        $event->endDate = Carbon::createFromFormat('d/m/Y', $data['end'])->addDay();
        $event->save();
    }
}