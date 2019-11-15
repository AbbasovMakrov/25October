<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $repository;
    public function __construct(UserRepositoryInterface $accountRepository)
    {
        $this->repository = $accountRepository;
    }
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = $this->repository->create();
        return api_response([
            "user" => [
                "info" => $user
            ]
        ]);
    }
}
