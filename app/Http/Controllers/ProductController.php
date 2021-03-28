<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\Product;
use App\Models\MarketUser;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $relation = MarketUser::find($request)[0];
        $products = $relation->market()->get()[0]->products()->get();

        return view('markets.products.index', compact('relation', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $relation = MarketUser::find($request->relation_id);
        $market = Market::find($relation->market_id);

        $product = Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'barcode' => (isset($request->barcode)) ? $request->barcode : null,
            'type' => $request->type,
            'price' => $request->price,
            'cost' => $request->cost,
            'market_id' => $relation->market_id
        ]);

        $file = $request->productImage;

        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $file->move(public_path('products/'.$market->uuid.'/', $file), 'product-' . $product->id . '.' . $extension);

        ProductImage::create([
            'is_url' => false,
            'image' => 'products/'.$market->uuid.'/product-' . $product->id . '.' . $extension,
            'product_id' => $product->id
        ]);

        $products = $relation->market()->get()[0]->products()->get();

        return view('markets.products.index', compact('relation', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAutomatic(Request $request)
    {
        // dd($request);

        $relation = MarketUser::find($request->relation_id);
        $market = Market::find($relation->market_id);

        $product = Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'barcode' => (isset($request->barcode)) ? $request->barcode : null,
            'type' => $request->type,
            'price' => $request->price,
            'cost' => $request->cost,
            'market_id' => $relation->market_id
        ]);

        if ($request->productImage != null) {
            $file = $request->productImage;

            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $file->move(public_path('products/'.$market->uuid.'/', $file), 'product-' . $product->id . '.' . $extension);

            ProductImage::create([
            'is_url' => false,
            'image' => 'products/'.$market->uuid.'/product-' . $product->id . '.' . $extension,
            'product_id' => $product->id
            ]);
        } else {
            ProductImage::create([
            'is_url' => true,
            'image' => $request->imageDefault,
            'product_id' => $product->id
            ]);
        }


        $products = $relation->market()->get()[0]->products()->get();

        return view('markets.products.index', compact('relation', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function soldProducts(Market $market)
    {
        $sells = DB::select("select product_id, name, sum(quant) 'cantidad' from products join sell_details sd on products.id = sd.product_id where market_id=? group by product_id order by 'Cantidad' asc", [$market->id]);
        // $months = DB::select('select sells.month, count(id) from sells group by sells.month order by sells.month;', []);

        return view('statistics', compact('sells'));
    }

    public function howToAdd(Request $request)
    {
        $relation = MarketUser::find($request)[0];

        return view('markets.products.howToCreate', compact('relation'));
    }

    public function automatic(Request $request)
    {
        $relation = MarketUser::find($request)[0];

        return view('markets.products.automatic', compact('relation'));
    }

    public function manual(Request $request)
    {
        $relation = MarketUser::find($request)[0];
        return view('markets.products.manual', compact('relation'));
    }
}
