<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestHomeController extends Controller
{
    public function index()
    {
        if (Auth::user()) return to_route('admin.home');
        else return to_route('login');
    }
}
