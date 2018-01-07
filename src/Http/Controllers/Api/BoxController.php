<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Box;
use Verkoo\Common\Entities\Session;
use Verkoo\Common\Events\SessionCreated;
use Illuminate\Http\Request;

class BoxController extends ApiController
{
    public function index() {
        return $this->respond(
            Box::with('sessions.orders.lines')->get()->toArray()
        );
    }

    public function store(Request $request)
    {
        $box = Box::with('sessions')->findOrFail($request->box_id);

        if ($box->hasOpenSession()) {
            return $this->respondWithError([
                'success' => false,
                'error'   => 'No puede abrir más de una sesión por caja'
            ]);
        }

        $session = new Session($request->all());
        $box->sessions()->save($session);

        event(new SessionCreated);

        $box->load('sessions.orders');
        return $this->respond($box);
    }

    public function update(Box $box, Request $request)
    {
        $session = $box->sessions->where('open', true)->first();

        if (! $session) {
            return $this->respondNotFound([
                'success' => false,
                'error'   => 'No hay sesiones abiertas en esta caja'
            ]);
        }

        $session->fill($request->all());
        $session->open = false;
        $session->save();
        $box->load('sessions.orders');

        return $this->respond($box);
    }
}
