<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketUser extends Model
{
    use HasFactory;

    protected $fillable =[
        'uuid',
        'market_id',
        'user_id',
        'role_id'
    ];
}
