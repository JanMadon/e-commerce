<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateFieldRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\BookkeepingService;
use App\Services\CategoryService;
use App\Services\OrderServiceInterface;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{

    private UserServiceInterface $userService;
    private CategoryService $categoryService;
    private BookkeepingService $bookkeepingService;
    private OrderServiceInterface $orderService;

    public function __construct(
        UserServiceInterface $userService,
        CategoryService $categoryService,
        BookkeepingService $bookkeepingService,
        OrderServiceInterface $orderService
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
            'latestOrders' => $this->orderService->getLatestOrders(5, true), 
            'mostPopularCategory' => $this->categoryService->getMostPopularCategory(),
            'latestUsers' => $this->userService->getLatestUsers(),
        ]);
    }

    public function raports()
    {
        $orderData = [];
        $orders = $this->orderService->getLatestOrders();
        foreach($orders as $order) {
            if(array_key_exists($order->payd_at, $orderData)){
                $orderData[$order->payd_at] += 1;
            } else {
                $orderData[$order->payd_at] = 1;
            }
        }

        //number registered Users

        $userData = [];
        $users = User::get();
        foreach($users as $user){
            $registered = $user->created_at->format('Y-m-d');
            if(array_key_exists($registered, $userData)){
                $userData[$registered] += 1;
            } else {
                $userData[$registered] = 1;
            }
        }
      

        return Inertia::render('Admin/Raports', [
            'ordersDates' => $orderData,
            'usersData' => $userData
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
