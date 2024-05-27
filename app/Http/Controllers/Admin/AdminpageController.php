<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminpageController extends Controller
{
    public function users() {
        return view('admin.users');
    }

    public function works() {
        return view('admin.works');
    }

    public function articles() {
        return view('admin.articles');
    }

    public function collaborations() {
        return view('admin.collaborations');
    }
}
