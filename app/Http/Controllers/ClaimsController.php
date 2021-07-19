<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Claim;
use App\Models\Leaderboard;
use App\Models\Reward;

class ClaimsController extends Controller
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

    // Index
    public function index()
    { if (Auth::user()->cannot('create reward') && Auth::user()->cannot('create order')) abort(403);
        
        $claims = Claim::paginate(10);
        if(Auth::user()->can('create order')) {
            $claims = Claim::where('user_id', Auth::id())->paginate(10); 
        }
     
        return view('pages.claims', ['claims' => $claims]);
    }

    // Create
    public function store(Request $request)
    { if (Auth::user()->cannot('create reward')) abort(403);
     
        $leaderboard = Leaderboard::where('user_id', Auth::id())->where('reward_id', $request['reward'])->first();
        $reward = Reward::findOrFail($request['reward']);
     
        $this->validate($request,[
            'qty' => 'required',
            'reward' => 'required',
        ]);
     
        $claim = Claim::create([
            'user_id' => Auth::user()->id,
            'reward_id' => $request['reward'],
            'quantity' => $request['qty'],
            'status' => 'Sedang di Proses',
        ]);
        
        $leaderboard->used = $leaderboard->used+($request['qty']*$reward->target);
        $leaderboard->save();
     
        session()->flash('success', 'Selamat, Reward kamu sedang di proses !');
        
        return redirect()->route('dashboard');
    }
    
    // Update
    public function update(Request $request, $id)
    { if (Auth::user()->cannot('create reward')) abort(403);
     
        $claim = Claim::findOrFail($id);
     
        $claim->status =  'Selesai';
        $claim->save();
        
		session()->flash('success', 'Reward selesai di proses !');
		
        return redirect()->back();
    }
}
