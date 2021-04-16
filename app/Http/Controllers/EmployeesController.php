<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\MarketUser;
use Illuminate\Http\Request;
use App\Models\RoleOnMarkets;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $currentRelation = MarketUser::find($request->relation_id);
        $employeesRelations = MarketUser::where('market_id', '=', $currentRelation->market_id)->get();
        $market = Market::find($currentRelation->market_id);
        $chief = $market->user()->get()[0];

        return view('markets.employees', compact('currentRelation', 'market', 'employeesRelations', 'chief'));
    }

    public function store(Request $request)
    {
        $market = Market::where('uuid', '=', $request->code)->get();

        $validator = $request->validate([
            'code' => ['required']
        ]);

        if (count($market) != 1) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return view('markets.confirm', compact('market'));
    }

    public function confirm(Request $request)
    {
        $market = Market::find($request->market_id);
        $user = Auth::user();
        $role = RoleOnMarkets::where('role', '=', 'Trabajador')->get();

        $relation = MarketUser::create([
            'uuid' => $market->uuid,
            'market_id' =>$market->id,
            'user_id' => $user->id,
            'role_id' => $role[0]->id
        ]);

        return redirect()->route('dashboard');
    }

    public function fire(Request $request)
    {
        $employeeRelation = MarketUser::find($request->employee_id);
        $employeeRelation->is_active = false;
        $employeeRelation->save();

        dd(MarketUser::find($request->employee_id));


        return redirect()->route('dashboard');
    }
}
