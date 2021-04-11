<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\MarketUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $relations = Auth::user()->marketRelation()->get();
        // dd($markets[0]->role()->get()[0]->role);

        // dd(Auth::user());

        if (!Auth::user()->password_verified) {
            return view('profile.checking-password', compact('relations'));
        }
        // dd(MarketUser::all());
        // dd($relations[0]->market()->get());

        return view('dashboard', compact('relations'));
    }

    public function checkingPassword(Request $request)
    {
        if ($request->password != $request->passwordConfirm) {
            return redirect()->back()->withErrors(['Las contraseñas no coinciden'])->withInput();
        } else {
            $user = Auth::user();
            $user->update([
                'password' => bcrypt($request->password),
                'password_verified' => true
            ]);

            return redirect()->route('dashboard');
        }
    }
}
