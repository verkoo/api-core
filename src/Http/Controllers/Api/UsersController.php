<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;

class UsersController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return $this->respond(Auth::user()->toArray());
    }
}
