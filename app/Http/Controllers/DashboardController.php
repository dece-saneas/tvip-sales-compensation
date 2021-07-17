<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reward;
use App\Models\Leaderboard;
use Auth;

class DashboardController extends Controller
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
        $rewards = Reward::where('period_end', '>=', Carbon::now()->subDay())->get();
        $leaderboards = Leaderboard::where('user_id', Auth::id())->get();
        
        if(Auth::user()->can('create reward')) {
            $rewards = Reward::all();
        }
        
        return view('dashboard', ['rewards' => $rewards, 'leaderboards' => $leaderboards]);
    }
}
