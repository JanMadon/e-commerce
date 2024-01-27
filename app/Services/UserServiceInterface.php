<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getUserWithInfo(int $id);
    public function getLastActiveUsersNumber(): int;
    public function getLatestUsers(): Collection;
    public function getAllUsers($search, $perPage = 15);
    public function updateField(int $userId, string $field, string $newValue);
}
