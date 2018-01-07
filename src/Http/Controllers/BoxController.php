<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Box;
use Verkoo\Common\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::boxes.index', compact('boxes'));
    }

    public function create()
    {
        return view('verkooCommon::boxes.create');
    }

    public function edit (Box $box)
    {
        $users = User::all()->pluck('name', 'id');

        return view('verkooCommon::boxes.edit', compact('box', 'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        Box::create($request->all());

        return redirect('boxes')->withMessage('Caja añadida con éxito');
    }

    public function update (Box $box, Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $box->update($request->all());

        return redirect('boxes')->withMessage('Caja actualizada con éxito');
    }

    public function destroy (Box $box)
    {
        try {
            $box->delete();
        } catch ( QueryException $e) {
            return redirect("boxes/{$box->id}/edit")->withErrors([
                'error' => 'No es posible eliminar el regitro. Es posible que tenga sesiones asociadas.'
            ]);
        }

        return redirect('boxes')->withMessage('Caja eliminada con éxito');
    }
}
