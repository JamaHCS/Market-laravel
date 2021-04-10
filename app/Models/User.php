<?php

namespace App\Models;

use App\Models\Market;
use App\Models\MarketUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasProfilePhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fb_token',
        'email',
        'password',
        'fb_id',
        'password_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the market associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function markets()
    {
        $queryMarkets = DB::select('select * from market_users where user_id = ?', [Auth::user()->id]);
        $markets = [];

        foreach ($queryMarkets as $query) {
            $market = Market::where('id', $query->market_id)->get()[0];
            array_push($markets, $market);
        }

        return $markets;
    }

    /**
     * Get all of the marketRelation for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketRelation()
    {
        return $this->hasMany(MarketUser::class, 'user_id', 'id');
    }
}
