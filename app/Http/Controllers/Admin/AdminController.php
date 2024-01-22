<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateFieldRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function userEdit(UserUpdateFieldRequest $request, int $id)
    {
        $data = $request->validated();
        $this->userService->updateField($id, $data['field'], $data['newValue']);
        
        return redirect()->back();
    }
}
