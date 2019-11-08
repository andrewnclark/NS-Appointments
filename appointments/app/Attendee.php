<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}