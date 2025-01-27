<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function register(Request $request)
    {



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phonenum' => $request->phonenum,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => "token"
        ], 201);
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['email' => "Invalid"]);
        }

        return response()->json(['token' => $user->createToken('auth_token')->plainTextToken], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);


        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8',
        ]);


        $user->update($validated);


        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,


        ]);
    }
}
