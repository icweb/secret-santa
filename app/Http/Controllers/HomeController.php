<?php

namespace App\Http\Controllers;

use App\Pair;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->admin)
        {
            return redirect()->route('pairs.index');
        }

        $pair = Pair::where('user_id', auth()->user()->id)->first();

        return view('home', compact('pair'));
    }
}
