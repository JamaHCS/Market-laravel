<?php

namespace App\Models;

use App\Models\Product;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_url',
        'image',
        'product_id',
    ];

    /**
     * Get the product that owns the ProductImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getUrlAttribute()
    {
        if ($this->is_url) {
            return $this->image;
        } else {
            return url('/')."/".$this->image;
        }
    }
}
