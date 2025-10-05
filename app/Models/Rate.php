<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['type', 'name', 'country', 'range', 'action', 'rate'];
}