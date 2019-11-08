<?php

namespace App\Events;

use App\Appointment;

class AppointmentCreated extends Event
{
    public $appointment;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment
    }
}
