<?php

namespace App\Strategy;
use Cloudinary;
use App\Contracts\ListingImage;
use App\Models\Listing;
use App\Models\ListingImages;

class CloudinaryStrategy implements ListingImage
{

    public function storeListingImage($image, Listing $listing)
    {
        $uploadedFileUrl = Cloudinary::upload($image->getRealPath())->getSecurePath();

        ListingImages::create(['url' => $uploadedFileUrl, 'listingId' => $listing->id]);
    }

}
