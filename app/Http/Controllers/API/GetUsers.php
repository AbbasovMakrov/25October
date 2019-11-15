<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GetUsers extends Controller
{
    /**
     * Handle the incoming request.
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return api_response(['users' => Cache::get("users")]);
    }
}
