<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponser;

    /**
     * Попытка авторизации
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request): Response
    {
        $request->authenticate();

        return $this->success(
            'Session created',
            ['token' => Auth::user()->createToken(config('auth.token_name'))->plainTextToken]
        );
    }

    /**
     * Удаление сессии авторизации
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(): Response
    {
        Auth::user()->tokens()->delete();

        return $this->success('Session destroyed');
    }
}
