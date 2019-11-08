<?php

namespace App\Listeners;

use App\Events\AppointmentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Mailer;
use App\Mail\AppointmentCreated;

class OnAppointmentCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(AppointmentCreated $event)
    {
        $mailer->to($event->appointment->attendee->email)->send(new AppointmentCreated($appointment));
    }
}
