<?php

namespace App\Models;

use App\Models\Market;
use App\Models\RoleOnMarkets;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketUser extends Model
{
    use HasFactory;

    protected $fillable =[
        'uuid',
        'market_id',
        'user_id',
        'role_id'
    ];

    protected $table = 'market_users';

    /**
     * Get the user associated with the MarketUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the market associated with the MarketUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    /**
     * Get the role associated with the MarketUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->belongsTo(RoleOnMarkets::class);
    }
}
