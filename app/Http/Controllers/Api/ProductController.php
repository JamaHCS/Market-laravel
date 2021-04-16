<?php

namespace App\Http\Controllers\Api;

use App\Models\Market;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiProductsResource;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('consults');
    }

    public function products(Request $request)
    {
        if (isset($request->market)) {
            $market = Market::find($request->market);
            $productsQuery = $market->products()->get();

            $products = [];

            foreach ($productsQuery as $product) {
                if ($product->is_active) {
                    array_push($products, new ApiProductsResource($product));
                }
            }

            return response()->json($products, 200);
        } elseif (isset($request->barcode)) {
            $product = Product::where('barcode', '=', $request->barcode)->get();

            return response()->json(new ApiProductsResource($product[0]), 200);
        } elseif (isset($request->search)) {
            $query = [];
            $statement = '%' . $request->search . '%';
            $products =[];

            $query = Product::where('name', 'like', $statement)->get();

            if (!isset($query[0])) {
                return response()->json('Producto no encontrado', 400);
            } else {
                foreach ($query as $el) {
                    array_push($products, new ApiProductsResource($el));
                }
            }

            return response()->json($products, 200);
        } elseif ($request->id) {
            $product = Product::find($request->id);

            return response()->json(new ApiProductsResource($product), 200);
        }

        return response()->json('Please, use a correct parameter', 400);
    }
}
