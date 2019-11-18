<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validation = validator($request->only(['name','password']),[
            "name" => ['required','string'],
            'password' => ['required','string']
        ]);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $data = $request->only(['name','password']);
        $data['role'] = "admin";
        if (auth()->attempt($data))
            return api_response([
                "user" => [
                    "info" => auth()->user(),
                    "token" => "Bearer " . auth()->user()->createToken('IDU')->accessToken
                ]
            ]);
        return api_response(null,['user' => ['These credentials do not match our records.']]);
    }
}
