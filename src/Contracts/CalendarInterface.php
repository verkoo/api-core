<?php

namespace Verkoo\Common\Contracts;

interface CalendarInterface
{
    public function getEvents();

    public function store($data);
}