<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppointmentsIntegrationTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @test
     */
    public function can_access_attendee()
    {
        $attendee = factory(App\Attendee::class)->create();
        $appointment = factory(App\Appointment::class)->create(['attendee_id' => $attendee->id]);

        $this->assertEquals($attendee->id, $appointment->attendee->id);
    }
}
