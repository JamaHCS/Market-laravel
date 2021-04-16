<?php

namespace App\Http\Controllers\Api;

use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    public function __construct()
    {
        $this->middleware('consults');
    }

    public function market(Market $market)
    {
        return response()->json($market, 200);
    }

    public function soldProducts(Market $market)
    {
        $query = DB::select("select product_id, name, sum(quant) 'Cantidad' from products join sell_details sd on products.id = sd.product_id where market_id=? group by product_id order by 'Cantidad' asc", [$market->id]);

        return response()->json($query, 200);
    }
}
