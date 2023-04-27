<?php

namespace App\Contracts;

use App\Models\Listing;

interface ListingImage
{
    public function storeListingImage($image, Listing $listing);

}
