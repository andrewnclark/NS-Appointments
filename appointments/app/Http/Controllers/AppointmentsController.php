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
     * A bad invalidated version that has much work to do. Should never
     * create models  here and id move the logic to jobs to allow synchronous
     * or queued execution but that would come with iteration.
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create([
            'attendee_id' => $request->input('attendee'),
            'staff_id' => $request->input('staff'),
            'location_id' => $request->input('location'),
            'service_id' => $request->input('service'),
            'start' => Carbon::createFromTimestamp($request->input('from')),
            'end' => Carbon::createFromTimestamp($request->input('to')),
        ]);

        event(new AppointmentCreated($appointment));

        return $this->response(
            $this->output->fromModel($appointment)
        );
    }

    public function destory($id)
    {
        // out of time
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
