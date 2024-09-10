<?php

declare(strict_types=1);

namespace App;

use PDO;

class Auth
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function login(string $username, string $password): void
    {
        $user = (new User())->getByUsername($username, $password);

        $query = "SELECT users.*, user_roles.role_id
              FROM users
              JOIN user_roles ON users.id = user_roles.user_id
              WHERE users.id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $user->id]);

        $userWithRoles = $stmt->fetch();

        if ($userWithRoles && $userWithRoles->role_id === Role::ADMIN) {
            redirect('/admin');
        }

        if ($userWithRoles) {
            $_SESSION['user'] = [
                'username' => $userWithRoles->username,
                'id'       => $userWithRoles->id,
                'role'     => $userWithRoles->role_id
            ];

            unset($_SESSION['message']['error']);
            redirect('/profile');
        }

        $_SESSION['message']['error'] = "Wrong email or password";
        redirect('/login');
    }

}