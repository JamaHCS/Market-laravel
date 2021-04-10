<?php

namespace App\Models;

use App\Models\Market;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketType extends Model
{
    use HasFactory;

    protected $fillable =[
        'name'
    ];

    /**
     * Get the market that owns the MarketType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class, 'type_id', 'id');
    }
}
