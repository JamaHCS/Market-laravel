<?php

namespace App\Models;

use App\Models\User;
use App\Models\Market;
use App\Models\SellDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_id',
        'user_id',
        'is_active'
    ];

    /**
     * Get the user that owns the Sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the market that owns the Sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id', 'id');
    }

    /**
     * Get all of the sell details for the Sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellDetails()
    {
        return $this->hasMany(SellDetail::class, 'sell_id', 'id');
    }
}
