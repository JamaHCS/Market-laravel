<?php

namespace App\Models;

use App\Models\Sell;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the products for the market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'market_id', 'id');
    }

    /**
     * Get all of the sells for the market
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sells(): HasMany
    {
        return $this->hasMany(Sell::class, 'market_id', 'id');
    }
}
