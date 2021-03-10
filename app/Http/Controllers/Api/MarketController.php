<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Market;
use App\Models\Location;
use App\Models\MarketUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketController extends Controller
{
    public function updateBasic(Request $request)
    {
        $market = null;
        try {
            $relation = MarketUser::find($request->relation_id);
            $user = User::find($relation->user_id);
            $market = Market::find($relation->market_id);

            if ($request->logo) {
                $file = $request->logo;
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $file->move(public_path('logos', $file), 'logo-' . $market->uuid . '.' . $extension);

                $market->update([
                'name' => $request->name,
                'logo' => 'logos/'.'logo-' . $market->uuid . '.' . $extension,
                'type_id' => $request->type_id
                ]);
            } else {
                $market->update([
                'name' => $request->name,
                'type_id' => $request->type_id
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
        return response()->json($market, 200);
    }

    public function updateLocation(Request $request)
    {
        $market = null;
        try {
            $relation = MarketUser::find($request->relation_id);
            $user = User::find($relation->user_id);
            $market = Market::find($relation->market_id);
            $location = $relation->market()->get()[0]->location()->get();

            if (count($location) == 0) {
                $location = Location::create([
                    "latitude" => $request->latitude,
                    "longitude" => $request->longitude
                ]);

                $market->location_id = $location->id;
                $market->save();
            } else {
                $location = $location[0];
                $location->latitude = $request->latitude;
                $location->longitude = $request->longitude;
                $location->save();
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
        return response()->json([$location, $market], 200);
    }
}
