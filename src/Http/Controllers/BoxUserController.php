<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Box;
use Verkoo\Common\Entities\User;
use Illuminate\Http\Request;

class BoxUserController extends Controller
{
    public function store(Box $box, Request $request)
    {
        $box->addUser(User::findOrFail($request->user_id));

        return redirect("/boxes/{$box->id}/edit");
    }

    public function destroy(Box $box, User $user)
    {
        $box->removeUser($user);

        return redirect("/boxes/{$box->id}/edit");
    }
}
