<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\User;

class ListingService
{

    private $userId;

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function storeListing(array $data, $userId): Listing
    {
        return Listing::create([
            'categoryId' => $data['category'],
            'locationId' => $data['location'],
            'guestCount' => $data['guestCount'],
            'roomCount' =>  $data['roomCount'],
            'bathroomCount' => $data['bathroomCount'],
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'userId' => $userId,
        ]);
    }

}
