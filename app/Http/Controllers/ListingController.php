<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Access\ListingImageContext;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use App\Services\ListingService;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Listing/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request, ListingService $listingService, ListingImageContext $context)
    {
        $validated = $request->validated();

        $listing = $listingService->storeListing($validated, auth()->id());

        foreach ($request->file('image') as $key => $image)
        {
            $context->store($image, $listing);
        }

        return redirect()->back()->with('toast', 'Listing create successfully');
    }

}
