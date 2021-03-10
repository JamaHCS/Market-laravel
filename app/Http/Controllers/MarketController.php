<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\MarketType;
use App\Models\MarketUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = MarketType::all();
        return view('markets.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $uuid = substr(uniqid(), 5);

        if ($request->type_id =='Selecciona una') {
            $request->type_id = 1;
        }

        $user = Auth::user();


        if (isset($request->logo)) {
            $file = $request->logo;
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $file->move(public_path('logos', $file), 'logo-' . $uuid . '.' . $extension);

            $market = Market::create([
            'name' => $request->name,
            'logo' => 'logos/'.'logo-' . $uuid . '.' . $extension,
            'user_id' => $user->id,
            'uuid' => $uuid,
            'type_id' => $request->type_id
        ]);
        } else {
            $market = Market::create([
            'name' => $request->name,
            'logo' => 'logos/logo.svg',
            'user_id' => $user->id,
            'uuid' => $uuid,
            'type_id' => $request->type_id
        ]);
        }






        $relation = MarketUser::create([
            'uuid' => $uuid,
            'market_id' => $market->id,
            'user_id' =>$user->id,
            'role_id' => 1
        ]);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function edit(Market $market)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Market $market)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market)
    {
        //
    }


    /**
     * Show the form for setting a config of a market.
     *
     * @return \Illuminate\Http\Response
     */
    public function config(Request $request)
    {
        $relation = MarketUser::find($request)[0];
        $types = MarketType::all();
        $location = $relation->market()->get()[0]->location()->get();

        if (count($location) == 0) {
            return view('markets.config', compact('relation', 'types'));
        } else {
            $location = $location[0];
            return view('markets.config', compact('relation', 'types', 'location'));
        }
    }
}
