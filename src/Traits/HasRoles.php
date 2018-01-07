<?php

namespace Verkoo\Common\Traits;

use Verkoo\Common\Entities\Role;

trait HasRoles
{
    public function  roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        return $this->roles()->sync([
            Role::whereName($role)->firstOrFail()->id
        ]);

    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function getAdminAttribute()
    {
        return !! $this->hasRole('admin');
    }

    /**
     * @return mixed
     */
    public function getRoleAttribute()
    {
        if (! $this->roles->first()) {
            return false;
        }
        
        return $this->roles->first()->name;
    }
}