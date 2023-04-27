<?php

namespace App\Access;

use App\Contracts\ListingImage;
use App\Models\Listing;
use App\Strategy\CloudinaryStrategy;

class ListingImageContext
{

    public function __construct(public ListingImage $strategy = new CloudinaryStrategy()){ }

    public function store($file, Listing $listing)
    {
        $this->strategy->storeListingImage($file, $listing);
    }

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

}
