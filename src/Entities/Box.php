<?php

namespace Verkoo\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['name', 'description'];
    protected $appends  = ['hasOpenSession', 'lastSession'];
    protected $hidden   = ['created_at', 'updated_at'];

    public function sessions() 
    {
        return $this->hasMany(Session::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeWithOpenSessions($query)
    {
        return $query->whereHas('sessions', function ($query) {
            $query->where('open', 1);
        });
    }

    public function addUser(User $user)
    {
        return $this->users()->sync([$user->id],false);
    }

    public function removeUser($user)
    {
        return $this->users()->detach([$user->id]);
    }

    public function hasOpenSession() 
    {
        return $this->sessions->where('open',true)->count() > 0;
    }

    public function getHasOpenSessionAttribute()
    {
        return $this->hasOpenSession();
    }

    public function getLastSessionAttribute()
    {
        return $this->sessions->last();
    }
}
