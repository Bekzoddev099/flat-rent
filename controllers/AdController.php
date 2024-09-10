<?php

declare(strict_types=1);

namespace Controller;

use App\Ads;
use App\Branch;
use App\Status;

class AdController
{

    public Ads $ads;

    public function __construct()
    {
        $this->ads = new Ads();
    }

    public function home(): void
    {
        $ads = $this->ads->getAds();
        $branches = (new Branch())->getBranches();

        loadView('home', ['ads' => $ads, 'branches' => $branches]);
    }

    public function show(int $id): void
    {
        $ad = $this->ads->getAd($id);
        $ad->image = "../assets/images/ads/$ad->image";

        loadView('single-ad', ['ad' => $ad]);
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
                user_id: (new \App\Session)->getId(),
                status_id: (int)$_POST['status_id'],
                branch_id: (int)$_POST['branch_id'],
                address: $address,
                price: $price,
                rooms: $rooms
            );

            if ($newAdsId) {
                $imageHandler = new \App\Image();
                $fileName = $imageHandler->handleUpload();

                if (!$fileName) {
                    exit('Rasm yuklanmadi!');
                }

                $imageHandler->addImage((int)$newAdsId, $fileName);

                redirect('/profile');
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
        loadView('dashboard/create-ad', ['ad' => (new \App\Ads())->getAd($id), 'branches' => $branches, 'statuses' => $statuses]);
    }

    public function edit(int $id): void
    {
        if ($_FILES['image']['error'] != 4) {
            $uploadPath = basePath("/public_html/assets/images/ads/");
            $image = new \App\Image();
            $image_name = $image->getImageByAdId($id);
            unlink(basePath($uploadPath . "/" . $image_name->name));
            $newFileName = $image->handleUpload();
            $image->updateImage($image_name->id, $newFileName);
        }
        $this->ads->updateAds(
            id: $id,
            title: $_POST['title'],
            description: $_POST['description'],
            user_id: (int)(new \App\Session)->getId(),
            status_id: (int)$_POST['status_id'],
            branch_id: (int)($_POST['branch_id']),
            address: $_POST['address'],
            price: (float)$_POST['price'],
            rooms: (int)$_POST['rooms']
        );
        redirect('/profile');
    }

    public function delete(int $id): void
    {
        $this->ads->deleteAds($id);
        redirect('/profile');
    }

    public function search(): void
    {
        $searchPhrase = $_REQUEST['search_phrase'];
        $searchBranch = $_GET['search_branch'] ? (int) $_GET['search_branch'] : null;
        $searchMinPrice = $_GET['min_price'] ? (int) $_GET['min_price'] : 0;
        $searchMaxPrice = $_GET['max_price'] ? (int) $_GET['max_price'] : PHP_INT_MAX;

        $ads = (new \App\Ads())->superSearch($searchPhrase, $searchBranch, $searchMinPrice, $searchMaxPrice);
        $branches = (new \App\Branch())->getBranches();
        loadView('home', ['ads' => $ads, 'branches' => $branches]);
    }
}