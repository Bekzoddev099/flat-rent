<?php

declare(strict_types=1);

namespace Controller;

use App\Branch;
use App\Session;
use App\Status;
use App\Ads;
use App\Image;

class AdController
{
    public Ads $ads;


    public function __construct()
    {
        $this->ads = new Ads();
    }

    public function show(int $id): void
    {
        $ad = $this->ads->getAd($id);
        $ad->image = "../assets/images/ads/$ad->image";

        loadView('single-ad', ['ad' => $ad]);
    }

    public function index(): void
    {
        $ads = $this->ads->getAds();
        loadView('dashboard/ads', ['ads' => $ads]);
    }

    public function create(): void
    {
        $branches = (new Branch())->getBranches();
        $statuses = (new Status())->getStatuses();
        loadView('dashboard/create-ad', ['branches' => $branches, 'statuses' => $statuses]);
    }

    public function store(): void
    {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = isset($_POST['price']) ? (float)$_POST['price'] : 0.0;
        $address = $_POST['address'] ?? '';
        $rooms = isset($_POST['rooms']) ? (int)$_POST['rooms'] : 0;

        if ($title && $description && $price && $address && $rooms) {
            $newAdsId = $this->ads->createAds(
                title: $title,
                description: $description,
                user_id: (new Session())->getId(),
                status_id: (int)$_POST['status_id'],
                branch_id: (int)$_POST['branch_id'],
                address: $address,
                price: $price,
                rooms: $rooms
            );

            if ($newAdsId) {
                $imageHandler = new Image();
                $fileName = $imageHandler->handleUpload();

                if (!$fileName) {
                    exit('Rasm yuklanmadi!');
                }

                $imageHandler->addImage((int)$newAdsId, $fileName);

                header('Location: /');
                exit();
            }

            return;
        }

        echo "Iltimos, barcha maydonlarni to'ldiring!";
    }

    public function update(int $id): void
    {
        $branches = (new Branch())->getBranches();
        $statuses = (new Status())->getStatuses();
        loadView('dashboard/create-ad', ['ad' => $this->ads->getAd($id), 'branches' => $branches, 'statuses' => $statuses]);
    }

    public function edit(int $id): void
    {
        if ($_FILES['image']['error'] != 4) {
            $uploadPath = basePath("/public_html/assets/images/ads/");
            $image = new Image();
            $image_name = $image->getImageByAdId($id);
            unlink(basePath($uploadPath . "/" . $image_name->name));
            $newFileName = $image->handleUpload();
            $image->updateImage($image_name->id, $newFileName);
        }

        $this->ads->updateAds(
            id: $id,
            title: $_POST['title'],
            description: $_POST['description'],
            user_id: (new Session())->getId(),
            status_id: (int)$_POST['status_id'],
            branch_id: (int)$_POST['branch_id'],
            price: (float)$_POST['price'],
            address: $_POST['address'],
            rooms: (int)$_POST['rooms']
        );
        redirect('/profile');
    }

    public function delete(int $id): void
    {
        $imageHandler = new Image();
        $image = $imageHandler->getImageByAdId($id);

        if ($image) {
            $uploadPath = basePath("/public/assets/images/ads/");
            $filePath = $uploadPath . $image->name;

            if ($image->name !== 'default.jpg' && file_exists($filePath)) {
                unlink($filePath);
                $imageHandler->deleteImage($image->id);
            }
        }

        $this->ads->deleteAd($id);
        redirect('/profile');
    }
}
