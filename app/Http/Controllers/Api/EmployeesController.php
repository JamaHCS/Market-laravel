<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Market;
use App\Models\MarketUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{
    public function adding(Request $request, $uuid)
    {
        $market = Market::where('uuid', '=', $uuid)->get()[0];

        $user = User::where('email', '=', $request->user)->get()[0];

        MarketUser::where('user_id', '=', $user->id)->update(['is_main' => false]);

        $relation = MarketUser::create([
            'uuid' => $market->uuid,
        'market_id' => $market->id,
        'user_id' => $user->id,
        'role_id' => 3,
        'is_main' => true
        ]);


        return response()->json($relation, 200);
    }
}
