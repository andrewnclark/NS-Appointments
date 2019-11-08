<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}