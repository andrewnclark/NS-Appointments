<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Transformers\Appointment as AppointmentTransformer;
use Carbon\Carbon;
use App\Events\AppointmentCreated;

class AppointmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AppointmentTransformer $appointment)
    {
        $this->output = $appointment;
    }

    public function index()
    {
        return $this->response(
            $this->output->fromCollection(Appointment::all())
        );
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);

        return $this->response(
            $this->output->fromModel($appointment)
        );
    }

    /**
     * A bad invalidated version that has much work to do.
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create([
            'attendee_id' => 1,
            'staff_id' => 1,
            'location_id' => 1,
            'service_id' => 1,
            'start' => Carbon::createFromTimestamp($request->input('from')),
            'end' => Carbon::createFromTimestamp($request->input('to')),
        ]);

        event(new AppointmentCreated($appointment));

        return $this->response(
            $this->output->fromModel($appointment)
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
