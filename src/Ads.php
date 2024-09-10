<?php

declare(strict_types=1);

namespace App;

use PDO;
use Exception;

class Ads
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    // Create a new ad
    public function createAds(
        string $title,
        string $description,
        int    $user_id,
        int    $status_id,
        int    $branch_id,
        string $address,
        float  $price,
        int    $rooms
    ): false|string {
        try {
            $query = "INSERT INTO ads (title, description, user_id, status_id, branch_id, address, price, rooms, created_at) 
                      VALUES (:title, :description, :user_id, :status_id, :branch_id, :address, :price, :rooms, NOW())";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':user_id' => $user_id,
                ':status_id' => $status_id,
                ':branch_id' => $branch_id,
                ':address' => $address,
                ':price' => $price,
                ':rooms' => $rooms
            ]);

            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }

    // Get a single ad by its ID
    public function getAd(int $id): false|array
    {
        try {
            $query = "SELECT ads.*, 
                             ads_image.name AS image, 
                             status.name AS status_name, 
                             branch.address AS branch_address,
                             branch.name AS branch_name
                      FROM ads
                      JOIN ads_image ON ads.id = ads_image.ads_id
                      JOIN status ON ads.status_id = status.id
                      JOIN branch ON ads.branch_id = branch.id
                      WHERE ads.id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        } catch (Exception $e) {
            return false;
        }
    }

    // Get all ads
    public function getAds(): false|array
    {
        try {
            $query = "SELECT *, ads.id AS id, ads.address AS address, ads_image.name AS image
                      FROM ads
                      JOIN branch ON branch.id = ads.branch_id
                      LEFT JOIN ads_image ON ads.id = ads_image.ads_id";

            return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC) ?: false;
        } catch (Exception $e) {
            return false;
        }
    }

    // Get ads for a specific user
    public function getUsersAds(int $userId): false|array
    {
        try {
            $query = "SELECT *, ads.id AS id, ads.address AS address, ads_image.name AS image
                      FROM ads
                      JOIN branch ON branch.id = ads.branch_id
                      LEFT JOIN ads_image ON ads.id = ads_image.ads_id
                      WHERE user_id = :userId";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':userId' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        } catch (Exception $e) {
            return false;
        }
    }

    // Update an existing ad
    public function updateAds(
        int    $id,
        string $title,
        string $description,
        int    $user_id,
        int    $status_id,
        int    $branch_id,
        string $address,
        float  $price,
        int    $rooms
    ): bool {
        try {
            $query = "UPDATE ads SET title = :title, description = :description, user_id = :user_id,
                     status_id = :status_id, branch_id = :branch_id, address = :address, 
                     price = :price, rooms = :rooms, updated_at = NOW() WHERE id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':id' => $id,
                ':title' => $title,
                ':description' => $description,
                ':user_id' => $user_id,
                ':status_id' => $status_id,
                ':branch_id' => $branch_id,
                ':address' => $address,
                ':price' => $price,
                ':rooms' => $rooms
            ]);

            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    // Delete an ad by its ID
    public function deleteAds(int $id): bool
    {
        try {
            $image = $this->pdo->query("SELECT name FROM ads_image WHERE ads_id = $id")->fetch(PDO::FETCH_OBJ)->name;
            if ($image && $image !== 'default.jpg') {
                unlink("assets/images/ads/$image");
            }

            $query = "DELETE FROM ads WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id' => $id]);

            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    // Super search functionality
    public function superSearch(
        string   $searchPhrase,
        int|null $searchBranch = null,
        int      $searchMinPrice = 0,
        int      $searchMaxPrice = PHP_INT_MAX
    ): false|array {
        try {
            $query = "SELECT *, 
                            ads.id AS id,
                            ads.address AS address,
                            ads_image.name AS image
                     FROM ads
                     JOIN branch ON branch.id = ads.branch_id
                     LEFT JOIN ads_image ON ads.id = ads_image.ads_id
                     WHERE (title LIKE :searchPhrase OR ads.description LIKE :searchPhrase)
                     AND price BETWEEN :minPrice AND :maxPrice";

            $params = [
                ':searchPhrase' => "%$searchPhrase%",
                ':minPrice' => $searchMinPrice,
                ':maxPrice' => $searchMaxPrice
            ];

            if ($searchBranch) {
                $query .= " AND branch_id = :searchBranch";
                $params[':searchBranch'] = $searchBranch;
            }

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        } catch (Exception $e) {
            return false;
        }
    }
}
