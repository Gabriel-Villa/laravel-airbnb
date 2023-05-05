<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\Reservation;
use Ramsey\Uuid\Type\Integer;

class ReservationService
{

    public function getTotalAmountReservation(int $listingPrice, $startDate, $endDate): int
    {
        $days = daysBetweenDates($startDate, $endDate);

        $totalAmount = $days * $listingPrice;

        return $totalAmount;
    }

    public function saveReservation(array $data, int $totalAmount): Reservation
    {
        return Reservation::create([
            'listingId' => $data['listingId'],
            'startDate' => $data['startDate'],
            'endDate' => $data['endDate'],
            'totalPrice' => $totalAmount,
            'createdAt' => now()->toDateString(),
        ]);
    }

}
