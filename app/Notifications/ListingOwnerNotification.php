<?php

namespace App\Notifications;

use App\Models\Listing;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ListingOwnerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Reservation $reservation){ }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Reservation')
                    ->from($this->reservation->listing->user->email, $this->reservation->listing->user->name)
                    ->greeting("Dear {$this->reservation->listing->user->name}")
                    ->line("
                        We are writing to inform you that a new reservation has been made on your listing:,
                        {$this->reservation->listing->title}.

                        The reservation was made by [{$this->reservation->listing->user->name}] for the dates
                        [{$this->reservation->startDate->format('d/m/Y')}
                        to
                        {$this->reservation->endDate->format('d/m/Y')}].
                    ");
    }

}
