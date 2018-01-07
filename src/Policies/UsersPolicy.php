<?php

namespace Verkoo\Common\Policies;

use Verkoo\Common\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function create(User $user)
    {
        return false;
    }
    
    public function edit(User $user, User $userToEdit)
    {
        return false;
//        return $user->id === $userToEdit->id;
    }

    public function delete(User $user)
    {
        return false;
    }
}
