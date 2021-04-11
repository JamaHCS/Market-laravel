<?php

namespace App\Models;

use App\Models\Sell;
use App\Models\Product;
use App\Models\Location;
use App\Models\MarketType;
use App\Models\MarketUser;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'user_id',
        'uuid',
        'location_id',
        'type_id'
    ];

    /**
     * Get all of the products for the market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all of the sells for the market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

    /**
     * Get the user that owns the Market
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the location associated with the Market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get all of the marketRelations for the Market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketRelations()
    {
        return $this->hasMany(MarketUser::class);
    }

    /**
     * Get the type associated with the Market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->belongsTo(MarketType::class);
    }
}
