<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    use ApiResponser;

    /**
     * Попытка авторизации
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request): Response
    {
        $user = User::create([
            'name' => $request->post('name'),
            'password' => bcrypt($request->post('password')),
            'email' => $request->post('email')
        ]);

        return $this->success([
            'token' => $user->createToken(config('auth.token_name'))->plainTextToken
        ]);
    }
}
