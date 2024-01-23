<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateFieldRequest;
use App\Models\DetalsOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\BookkeepingService;
use App\Services\CategoryService;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AdminController extends Controller
{

    private UserService $userService;
    private CategoryService $categoryService;
    private BookkeepingService $bookkeepingService;
    private OrderService $orderService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        BookkeepingService $bookkeepingService,
        OrderService $orderService
        )
    {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->bookkeepingService = $bookkeepingService;
        $this->orderService = $orderService;
    }

    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'loggedInUsers' => $this->userService->getLastActiveUsersNumber(),
            'registeredUsers' => User::count(),
            'activeProducts' => Product::whereNot('status', 'deleted')->count(),         
            'paidOrders' => Order::where('payment', 'accepted')->count(),
            'totalIncome' => $this->bookkeepingService->getTotalIncome(),
            'latestOrders' => $this->orderService->getLatestOrders(), 
            'mostPopularCategory' => $this->categoryService->getMostPopularCategory(),
            'latestUsers' => $this->userService->getLatestUsers(),
        ]);
    }

    public function raports()
    {
        dd('raports');
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
