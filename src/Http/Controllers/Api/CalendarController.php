<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Contracts\CalendarInterface;

class CalendarController extends ApiController
{
    private $calendar;

    public function __construct(CalendarInterface $calendar)
    {
        $this->calendar = $calendar;
    }

    public function index()
    {
        return $this->calendar->getEvents();
    }

    public function store()
    {
        $this->validate(request(), [
            'start' => 'date_format:"d/m/Y"|required',
            'end' => 'date_format:"d/m/Y"|required|after_or_equal:start',
            'title' => 'required',
        ]);

        $this->calendar->store(request()->all());

        return response(['success' => true], 201);

    }
}
