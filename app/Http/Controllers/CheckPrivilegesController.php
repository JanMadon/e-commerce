<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPrivilegesController extends Controller
{
    public function index() {
        
        if(Auth::user()->level === 'admin') {
            return to_route('admin.dashboard');
        } else {
            return to_route('home');
        }
    }
}
