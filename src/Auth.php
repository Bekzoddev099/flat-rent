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

    public function login(string $username, string $password)
    {
        // Get user or fail
        $user = (new User())->getByUsername($username, $password);

        if (!$user) {
            $_SESSION['message']['error'] = "Wrong email or password";
            redirect('/login');
            return;
        }

        // Get users role
        $query = "SELECT users.*, user_roles.role_id
                  FROM users
                  JOIN user_roles ON users.id = user_roles.user_id
                  WHERE users.id = :user_id";

        // Tayyorlangan so'rovdan foydalanish
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $user->id]);
        $userWithRoles = $stmt->fetch();

        // Rollarni tekshirish
        if ($userWithRoles && $userWithRoles->role_id === Role::ADMIN) {
            redirect('/admin');
            return;
        }

        if ($userWithRoles) {
            $_SESSION['user'] = [
                'username' => $userWithRoles->username,
                'id'       => $userWithRoles->id,
                'role'     => $userWithRoles->role_id
            ];

            unset($_SESSION['message']['error']);
            redirect('/profile');
            return;
        }

        $_SESSION['message']['error'] = "Wrong email or password";
        redirect('/login');
    }
}
