<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Create new user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed|min:8'
        ]);
        
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('token_key')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    /**
     * Login a user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        $fields = $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password )){
            return response([
                'message' => 'Incorrect credentials'
            ], 401);
        }

        $token = $user->createToken('token_key')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;

    }

    /**
     * Logout a user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'User logged out'
        ]);
    }

   
}
