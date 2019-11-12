<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (empty(auth()->user())) {
            return redirect()->route('login');
        }
        return view('admin');
    }
}
