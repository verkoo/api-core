<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Jobs\OpenDrawerJob;

class OpenDrawer extends ApiController
{
    public function __invoke()
    {
        dispatch(new OpenDrawerJob());
    }
}
