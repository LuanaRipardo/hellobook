<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $reader = Reader::where('email', $request->email)->first();
    if (!$reader || !Hash::check($request->password, $reader->password)) {
        return response([
            'message' => 'The provided credentials are incorrect.'
        ], 400);
    }

    $token = JWTAuth::fromUser($reader);

    return response([
        'token' => $token
    ]);
}

}
