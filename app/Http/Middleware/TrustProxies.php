<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    protected $proxies;

    //ss upgraded laravel version from 5.5 to 5.6 via https://www.youtube.com/watch?v=GzFts60G2NI
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
