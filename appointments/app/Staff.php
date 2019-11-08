<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}