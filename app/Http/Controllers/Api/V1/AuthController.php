<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Client;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|min:6|max:20|confirmed',
            'phone_number' => 'required|min:6|max:12',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
        ]);

        return response()->json(["success"=>"Client created successfully"]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $client = Client::where('email', $request->email)->first();

        if (! $client || ! Hash::check($request->password, $client->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $client->createToken('auth-token')->plainTextToken;
    }
}
