<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Rules\isNameAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validation  = validator($request->all(),[
            "name" => ['required','string',new isNameAvailable],
            "password" => ['nullable','string']
        ]);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $data = [
          "name" => $request->name,
        ];
        if ($request->password)
            $data['password'] = Hash::make($request->password);
        $user = auth()->user();
        $user->update($data);
        if (!$user)
            return api_response(null,['user' => ['data not updated']]);
        return api_response(['user' => $user]);
    }
}
