<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

use function Laravel\Prompts\search;

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

    public function userInfo(Request $request, int $id)
    {
        // dd($id);
       
        $user = User::with('address')->find($id);
        $user->lastOrder = Order::userLastOrder($id);
        $user->numOfOrder = Order::userNumOfOrders($id);

        return Inertia::render('Admin/UserInfo',[
            'user' => $user,
        ]);
    }
}
