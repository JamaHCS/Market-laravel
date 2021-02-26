<?php

namespace App\Models;

use App\Models\Market;
use App\Models\SellDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'cost',
        'image,',
        'market_id'
    ];


    /**
     * Get the merket that owns the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id', 'id');
    }

    /**
     * Get the sellDetail that owns the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellDetail()
    {
        return $this->belongsTo(SellDetail::class, 'product_id', 'id');
    }
}
