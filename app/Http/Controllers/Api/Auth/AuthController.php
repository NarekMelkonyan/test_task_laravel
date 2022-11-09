<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;

        return response()->json(['token' => $token], Response::HTTP_OK);
    }

    /**
     * Login Req
     */
    public function login(Request $request): JsonResponse
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
            return response()->json(['token' => $token], Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function userInfo(): JsonResponse
    {
        $user = auth()->user();
        return response()->json(['user' => $user], Response::HTTP_OK);

    }
}
