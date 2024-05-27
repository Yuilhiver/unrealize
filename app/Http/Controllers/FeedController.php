<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $followingsIDs = Auth::user()->followings()->pluck('id');
        $followings = User::whereIn('id', $followingsIDs)->get();

        return view('feed',[
            'followings' => $followings
        ]);
    }
}
