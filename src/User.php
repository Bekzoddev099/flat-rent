<?php

declare(strict_types=1);

namespace RentApp;

use PDO;

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function create(
        string $username,
        string $position,
        string $gender,
        string $phone): false|array
    {
        $query = "INSERT INTO users (username, position, gender, phone, created_at) Values (:username, :position, :gender, :phone, NOW())";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':position', $position);
        $stmt->bindValue(':gender', $gender);
        $stmt->bindValue(':phone', $phone);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getUser(int $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function update(int $id, string $username, string $position, string $gender, string $phone):void
    {
        $query = "Update users Set username = :username, position = :position, gender = :gender, phone = :phone, update_at= NOW()
    WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

    }
    public function delete(int $id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}