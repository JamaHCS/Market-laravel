<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $relations = Auth::user()->marketRelation()->get();
        // dd($markets[0]->role()->get()[0]->role);
        return view('dashboard', compact('relations'));
    }
}
