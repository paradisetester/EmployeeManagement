<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Static Home Page
    public function index()
    {
        return view('home'); // resources/views/home.blade.php
    }

    // Dashboard Page
    public function dashboard()
    {
        return view('dashboard'); // resources/views/dashboard.blade.php
    }
    // Login page
    public function showLoginForm(){
    return view('auth.login');
    }

}
