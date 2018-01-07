<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Role;
use Verkoo\Common\Entities\User;
use Verkoo\Common\Http\Requests\CreateUserRequest;
use Verkoo\Common\Http\Requests\UpdateUserRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('create', Auth::user());

        $users = User::orderBy('name', 'ASC')->paginate();
        
        return view('verkooCommon::users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->pluck('label', 'name');

        $this->authorize('create', Auth::user());

        return view('verkooCommon::auth.register', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($this->getFields($request->all()));

        $user->assignRole($request->role);

        return redirect('/users')->withMessage('Usuario añadido con éxito');
    }

    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        $roles = Role::all()->pluck('label', 'name');

        return view('verkooCommon::auth.edit', compact('user', 'roles'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $fields = $this->getFields($request->all());
        $user->update($fields);

        if (auth()->user()->hasRole("admin")) {
            $user->assignRole($request->role);
            return redirect("/users")->withMessage('Usuario actualizado con éxito');;
        }

        return redirect("/users/{$user->id}/edit");
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        try {
            $user->delete();
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(["error" => "Imposible eliminar usuario. Tiene pedidos asociados."]);
        }

        return redirect('/users')->withMessage('Usuario eliminado con éxito');
    }

    protected function getFields($data)
    {
        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        else
        {
            unset($data['password']);
        }

        return $data;
    }
}
