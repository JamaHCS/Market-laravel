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

        $user = User::where('email', '=', $request->uid)->get()[0];

        $relation = MarketUser::create([
            'uuid' => $market->uuid,
        'market_id' => $market->id,
        'user_id' => $user->id,
        'role_id' => 3
        ]);


        return response()->json($relation, 200);
    }
}
