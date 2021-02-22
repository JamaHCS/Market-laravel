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
        'total',
        'market_id',
        'user_id',
        'market_id'
    ];

    /**
     * Get the user that owns the Sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the market that owns the Sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id', 'id');
    }

    /**
     * Get all of the sell details for the Sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellDetails(): HasMany
    {
        return $this->hasMany(SellDetail::class, 'sell_id', 'id');
    }
}
