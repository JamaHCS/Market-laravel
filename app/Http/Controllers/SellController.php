<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Market;
use App\Models\Product;
use App\Models\MarketUser;
use App\Models\SellDetail;
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

        $sells = Sell::where('market_id', '=', $market->id)->orderBy('id', 'desc')->paginate(7);

        // dd($relation);

        return view('sells.index', compact('sells', 'relation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $relation = MarketUser::find($request->relation_id);
        $products = $relation->market()->get()[0]->products()->get();

        foreach ($products as $el) {
            $el->image = $el->image()->get()[0]->url;
        }


        return view('sells.create', compact('relation', 'products'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $state = $request->state;
        $raw = json_decode($state);
        $relation =MarketUser::find($request->relation_id);
        $market = Market::find($relation->market_id);

        // dd($relation);

        $sell = Sell::create([
            "market_id" => $relation->market_id,
            "user_id" => $relation->user_id,
            "is_active" => true
        ]);

        foreach ($raw as $val) {
            $product = Product::find($val->id);
            $total = $val->quant * $product->price;

            $detail = SellDetail::create([
                "quant" => $val->quant,
                "total" => $total,
                "sell_id" => $sell->id,
                "product_id" => $product->id
            ]);
        }

        $sells = Sell::where('market_id', '=', $market->id)->orderBy('id', 'desc')->paginate(7);


        // $sells = $relation->market()->get()->sells()->get();

        return view('sells.index', compact('sells', 'relation'));
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
