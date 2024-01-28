<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{

    public function getUserWithInfo(int $id)
    {
        $user = User::with('address')->find($id);
        $user->lastOrder = Order::userLastOrder($id);
        $user->numOfOrder = Order::userNumOfOrders($id);
        return $user;
    }

    public function getLastActiveUsersNumber(): int
    {
        return User::where('last_activity', '>', now()->subMinutes(5)->getTimestamp())
            ->count();
    }

    public function getLatestUsers(): Collection
    {

        $users = User::where('last_activity', '>', now()->subWeeks(2)
            ->getTimestamp())->orderBy('last_activity', 'desc')->get();
        
            foreach($users as $user) {
                $time =  Carbon::parse($user->last_activity)->diffForHumans();
                $user->lastTime = $time; 
            }

        return $users;
    }


    public function getAllUsers($search, $perPage = 15)
    {
        $query = User::with('address')
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('name', 'like', "$search%")
                ->orWhere('email', 'like', "%$search%");
        }
        $query = $query->paginate($perPage);

        return $query;
    }

    public function updateField(int $userId, string $field, string $newValue)
    {
        User::find($userId)->update([$field => $newValue]);
    }
}
