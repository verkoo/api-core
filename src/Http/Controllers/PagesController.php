<?php

namespace Verkoo\Common\Http\Controllers;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('verkooCommon::dashboard');
    }

    public function tpv()
    {
        return view('verkooCommon::tpv');
    }

    public function orders()
    {
        return view('verkooCommon::orders.index');
    }

    public function annotations()
    {
        return view('verkooCommon::annotations.index');
    }

    public function calendar()
    {
        return view('verkooCommon::calendar.index');
    }

    public function contacts()
    {
        return view('verkooCommon::contacts.index');
    }

    public function sessions()
    {
        return view('verkooCommon::boxes.sessions');
    }

    public function defaultDelivery()
    {
        return view('verkooCommon::default-delivery-notes.index');
    }

    public function delivery()
    {
        return view('verkooCommon::delivery-notes.index');
    }

    public function quotes()
    {
        return view('verkooCommon::quotes.index');
    }

    public function invoices()
    {
        return view('verkooCommon::invoices.index');
    }

    public function expeditureDelivery()
    {
        return view('verkooCommon::expediture-delivery-notes.index');
    }
}
