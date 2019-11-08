<?php

namespace App\Transformers;

use App\Appointment as Model;

/**
 * Use a dedicated transformation class, since the API specification wasn't provided this
 * will allow me to change out the data format with relative ease. Could potentially use the
 * container to bind the implementation to an interface.
 * 
 * Should extract an interface here for other models but since we focusing on Appointments
 * its not needed in current spec.
 */

class Appointment
{
    public function fromModel(?Model $model): array
    {
        if($model == null) {
            return [];
        }

        return [
            'appointment_id' => $model->id,
        ];
    }

    public function fromCollection($collection): array
    {
        return [];
    }
}