<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Listing;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function store(StoreReservationRequest $request, ReservationService $reservationService)
    {
        try {

            $listing = Listing::where('id', $request->listingId)->first();

            $totalAmount = $reservationService->getTotalAmountReservation(
                listingPrice: $listing->price,
                startDate: $request->startDate,
                endDate: $request->endDate
            );

            $reservationService->saveReservation($request->validated(), $totalAmount);

            return redirect()->route('home')->with('toast', 'Successfully reserved');

        } catch (\EXception $th)
        {
            return redirect()->back()->with('toast', 'Please try again');
        }
    }

}
