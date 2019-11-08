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
        return $this->response(
            $this->transformer->fromCollection(Appointment::all())
        );
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);

        return $this->response(
            $this->transformer->fromModel($appointment)
        );
    }

    /**
     * I don't like this and would prefer to move the responses
     * into classes of their own; either CollectionResponse($data) or
     * ResourceResponse($data)
     */
    private function response(array $data)
    {
        if(empty($data)) {
            return abort(404);
        }

        return response()->json($data);
    }
}
