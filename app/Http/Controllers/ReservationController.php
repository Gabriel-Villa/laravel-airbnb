<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Listing;
use App\Providers\NewListingReservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function store(StoreReservationRequest $request, ReservationService $reservationService)
    {
        try {

            $listing = Listing::where('id', $request->listingId)->first();

            $totalAmount = $reservationService->getTotalAmountReservation(
                listingPrice: (int) $listing->getPriceWithOutFormat(),
                startDate: $request->startDate,
                endDate: $request->endDate
            );

            $reservation = $reservationService->saveReservation($request->validated(), $totalAmount);

            event(new NewListingReservation($reservation));

            return redirect()->route('home')->with('toast', 'The request was sent to the owner');

        } catch (\EXception $th)
        {
            return redirect()->back()->with('toast', 'Please try again');
        }
    }

}
