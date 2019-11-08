<?php

use App\Transformers\Appointment;

class AppointmentTransformerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function transforms_a_model_to_array_for_response_body()
    {
        $appointment = factory(App\Appointment::class)->make([
            'id' => 123,
            'location_id' => 1,
            'staff_id' => 1,
            'attendee_id' => 1,
            'service_id' => 1
        ]);

        $transformer = new Appointment();
        
        $transformed = $transformer->fromModel($appointment);

        $this->assertEquals($transformed, ['appointment_id' => $appointment->id]);
    }
}
