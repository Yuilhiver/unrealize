<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Models\Work;

class IndexController extends Controller
{
    public function index(){

        $bestWorks = Work::with('user')->orderBy('rating', 'desc')->take(3)->get();
        $collaborations = Collaboration::with('user')->orderBy('created_at', 'asc')->take(4)->get();

        return view('index',compact('bestWorks','collaborations'));
    }
}
