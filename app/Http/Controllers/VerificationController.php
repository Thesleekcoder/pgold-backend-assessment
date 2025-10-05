<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)
                    ->where('email_verification_code', $request->code)
                    ->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Invalid code'], 400);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->save();

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json(['status' => 'success', 'data' => ['user' => $user->only('id', 'username'), 'token' => $token]]);
    }

    public function toggleFaceId(Request $request)
    {
        $request->validate(['enable' => 'required|boolean']);
        $user = $request->user();
        $user->face_id_enabled = $request->enable;
        $user->save();
        return response()->json(['status' => 'success', 'data' => ['face_id_enabled' => $user->face_id_enabled]]);
    }
}