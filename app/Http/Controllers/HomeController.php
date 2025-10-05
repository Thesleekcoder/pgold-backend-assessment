<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $wallet = $user->wallet;

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => ['full_name' => $user->full_name, 'username' => $user->username],
                'wallet' => ['balance_ngn' => (float) $wallet->balance_ngn, 'balance_usd' => (float) $wallet->balance_usd],
                'quick_actions' => [['name' => 'Crypto'], ['name' => 'Giftcards'], /* ... */],
                'referral_banner' => ['title' => 'Earn cash rewards...']
            ]
        ]);
    }
}