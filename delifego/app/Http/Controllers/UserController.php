<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function update(Request $request, $id)
{
    // البحث عن المستخدم بناءً على $id
    $user = User::find($id);

  
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }


    $validated = $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|unique:users,email,' . $user->id,
    ]);

   
    $user->update($validated);

   
    return response()->json([
        'message' => 'User updated successfully',
        'user' => $user,
    ]);
}

}

