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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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

        $file = $request->logo;
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

        $file->move(public_path('logos', $file), 'logo-' . $uuid . '.' . $extension);

        $user = Auth::user();

        $market = Market::create([
            'name' => $request->name,
            'logo' => 'logos/'.'logo-' . $uuid . '.' . $extension,
            'user_id' => $user->id,
            'uuid' => $uuid,
            'type_id' => $request->type_id
        ]);

        $relation = MarketUser::create([
            'uuid' => $uuid,
            'market_id' => $market->id,
            'user_id' =>$user->id,
            'role_id' => 1
        ]);

        dd([$market, $relation]);
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
}
