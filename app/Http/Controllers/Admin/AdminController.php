<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
   
    public function dashboard()
    {
        $users = User::paginate();
       
        return Inertia::render('Admin/UserList', [
            'users' => $users 
        ]);
    }


    public function usersList()
    {
        $users = User::paginate();
       
        return Inertia::render('Admin/UserList', [
            'users' => $users 
        ]);
    }
}
