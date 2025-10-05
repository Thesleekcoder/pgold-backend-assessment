<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:crypto,giftcard',
            'name' => 'required',
            'action' => 'required|in:buy,sell',
            'value' => 'required|numeric|min:0.01'
        ]);

        $rate = Rate::where('type', $request->type)
                    ->where('name', $request->name)
                    ->where('action', $request->action)
                    ->first();

        if (!$rate) {
            return response()->json(['status' => 'error', 'message' => 'Rate not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'rate' => (float) $rate->rate,
                'total_value_ngn' => (float) ($request->value * $rate->rate)
            ]
        ]);
    }
}