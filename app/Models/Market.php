<?php

namespace App\Models;

use App\Models\Sell;
use App\Models\Product;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'user_id',
        'uuid',
        'user_id',
        'location_id'
    ];

    /**
     * Get all of the products for the market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'market_id', 'id');
    }

    /**
     * Get all of the sells for the market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sells()
    {
        return $this->hasMany(Sell::class, 'market_id', 'id');
    }

    /**
     * Get the user that owns the Market
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the location associated with the Market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(Location::class, 'location_id', 'id');
    }
}
