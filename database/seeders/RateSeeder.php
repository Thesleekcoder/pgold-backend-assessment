<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    public function run()
    {
        Rate::create(['type' => 'crypto', 'name' => 'BTC', 'action' => 'buy', 'rate' => 100000.00]);
        Rate::create(['type' => 'giftcard', 'name' => 'Amazon', 'action' => 'buy', 'rate' => 1400.00]);
    }
}