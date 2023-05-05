<?php

namespace App\Providers;

use App\Notifications\ListingOwnerNotification;
use App\Providers\NewListingReservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;

class SendEmailReservationListingOwner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewListingReservation $event): void
    {
        Notification::send($event->reservation->listing->user, new ListingOwnerNotification($event->reservation));
    }
}
