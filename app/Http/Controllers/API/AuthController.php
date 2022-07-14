<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Rules\hasNumber;

class AuthController extends Controller
{
    public function register(Request $request)
    {   
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'drivers_licence_number' => 'required|string|max:12',
            'password' => ['required', 'string', 'min:8', new hasNumber],
            ]);
        
        if ($validator->fails())
            return response()->json($validator->errors());

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'drivers_licence_number' => $request->drivers_licence_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi ' . $user->first_name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return ['message' => 'You have successfully logged out and the token was successfully deleted'];
    }
  
}
