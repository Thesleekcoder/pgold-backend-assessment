<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'full_name' => 'required',
            'phone_number' => 'required',
            'password' => 'required|min:8|confirmed',
            'source' => 'nullable|in:Referral,Social Media,Website,Ad,Instagram,Newspaper,Billboard',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code ?? '+234',
            'referral_code' => $request->referral_code,
            'source' => $request->source,
            'password' => Hash::make($request->password),
            'email_verification_code' => rand(100000, 999999),
        ]);

        Wallet::create(['user_id' => $user->id]);

        // For assessment: log OTP (remove in real app)
        \Log::info("OTP for {$user->email}: {$user->email_verification_code}");

        return response()->json(['status' => 'success', 'message' => 'User registered. Check logs for OTP.', 'data' => ['user_id' => $user->id]]);
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
        }

        if (!$user->email_verified_at) {
            return response()->json(['status' => 'error', 'message' => 'Email not verified'], 403);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json(['status' => 'success', 'data' => ['user' => $user->only('id', 'username'), 'token' => $token]]);
    }
}