<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->unauthorized(['usuario y/0 contraseña incorrectos >=(']);
            }
            $user = User::query()->where('email', '=', $credentials['email'])->first();
            return response()->succes(compact('user', 'token'));
        }catch (\Exception $e){
            return response()->unprocessable('ERROROROROOROROROROR', [$e->getMessage()]);
        }
    }
}
