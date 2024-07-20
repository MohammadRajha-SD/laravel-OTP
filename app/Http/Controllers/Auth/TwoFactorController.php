<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index(){
        return view('auth.verify');
    }   
    public function store(Request $request){
        $user = auth()->user();

        if ($user->code == $request->code){
            $user->resetCode();
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['code'=> 'code is not correct']);
    }
}
