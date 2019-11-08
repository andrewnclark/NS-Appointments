<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Transformers\Appointment as AppointmentTransformer;

class AppointmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AppointmentTransformer $appointment)
    {
        $this->transformer = $appointment;
    }

    public function index()
    {
        
    }

    public function show(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        return $this->response(
            $this->transformer->fromModel($appointment)
        );
    }

    private function response(array $data)
    {
        return response()->json($data);
    }
}
