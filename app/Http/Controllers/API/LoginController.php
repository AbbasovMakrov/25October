<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __invoke(Request $request)
    {
        $validation = validator($request->all(),[
            "name" => ['required','string'],
            "password" => ['required','string']
        ]);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $credentials = $request->only(['name','password']);

        if (!\auth()->attempt($credentials))
            return api_response(null,$validation->errors()->add("user","These credentials do not match our records."));
        return api_response([
            "user" => [
                "info" => Auth::user(),
                "token" => "Bearer " . Auth::user()->createToken('IDU')->accessToken
            ]
        ]);
    }
}
