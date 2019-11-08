<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}