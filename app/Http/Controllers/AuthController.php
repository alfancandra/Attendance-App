<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        $register = User::all();
        $response = [
            'message' => 'User list',
            'data' => $register
        ];

        return response()->json($response,Response::HTTP_OK);
    }
}
