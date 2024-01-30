<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CheckPrivilegesController extends Controller
{
    public function index() {

        if(Auth::check()) {
            if(Auth::user()->level === 'admin') {
                return to_route('dashboard');
            } else {
                return to_route('home');
            }
        } else {
            return to_route('login');
        }
    }
}
