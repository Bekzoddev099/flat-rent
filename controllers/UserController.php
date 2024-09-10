<?php

declare(strict_types=1);

namespace Controller;

use App\Ads;
use App\Session;
use App\User;

class UserController
{
    public function loadProfile(): void
    {
        $ads = (new Ads())->getUsersAds((new Session())->getId());
        loadView('profile', ['ads' => $ads]);
    }

    public function index(): void
    {
        $users = (new User())->getUsers();
        loadView('dashboard/users', ['users' => (new User())->getUsers()]);
    }

    public function show(int $id): void
    {
        $user = (new User())->getUser($id);
        $ads  = (new Ads())->getUsersAds((new Session())->getId());

        loadView('profile-info', ['user' => $user, 'ads' => $ads]);
    }

    public function update(int $id): void
    {
        $user = (new User())->getUser($id);
        loadView('edit-profile', ['user' => $user]);
    }
}