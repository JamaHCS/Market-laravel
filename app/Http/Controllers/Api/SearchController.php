<?php

namespace App\Http\Controllers\Api;

use App\Models\Market;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('consults');
    }

    public function products(Market $market)
    {
        $products = $market->products()->get();

        foreach ($products as $el) {
            $el->image = $el->image()->get()[0]->url;
        }


        return response()->json($products, 200);
    }

    public function search(Request $request)
    {
        $query = [];
        $statement = '%' . $request->toSearch . '%';

        if (ctype_digit($request->toSearch)) {
            $query = Product::where('barcode', 'like', $statement)->get();
        } else {
            $query = Product::where('name', 'like', $statement)->get();
        }

        if (!isset($query[0])) {
            return response()->json('Producto no encontrado', 400);
        } else {
            foreach ($query as $el) {
                $el->image = $el->image()->get()[0]->url;
            }
        }

        return response()->json($query, 200);
    }
}
