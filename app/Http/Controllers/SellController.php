<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Market;
use App\Models\MarketUser;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // dd($id);
        $relation = MarketUser::find($id);
        $market = Market::find($relation->market_id);
        $sells = Sell::where('market_id', '=', $market->id)->paginate(7);

        // dd($relation);

        return view('sells.index', compact('sells', 'relation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sell = Sell::find($request->sell_id);
        $relation = MarketUser::find($request->relation_id);

        // dd([$sell, $relation]);
        return view('sells.show', compact('sell', 'relation'));
    }

    public function delete(Request $request)
    {
        $sell = Sell::find($request->sell_id);
        $sell->update(['is_active' => false]);

        return redirect('dashboard');
    }
}
