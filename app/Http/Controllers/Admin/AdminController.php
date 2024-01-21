<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

use function Laravel\Prompts\search;

class AdminController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        $users = User::paginate();

        return Inertia::render('Admin/UserList', [
            'users' => $users
        ]);
    }


    public function usersList(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('perPage');

        $users = $this->userService->getAllUsers($search, $perPage);

        return Inertia::render('Admin/UserList', [
            'users' => $users
        ]);
    }

    public function userInfo(int $id)
    {
        if (!User::find($id)) {
            abort(404);
        }

        return Inertia::render('Admin/UserInfo', [
            'user' => $this->userService->getUserWithInfo($id),
        ]);
    }
}
