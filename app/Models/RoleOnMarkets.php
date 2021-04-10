<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\MarketUser;

class RoleOnMarkets extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
    ];

    protected $collection = 'role_on_markets';

    /**
     * Get the marketRelation that owns the RoleOnMarkets
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketRelation()
    {
        return $this->belongsTo(MarketUser::class, 'role_id', 'id');
    }
}
