<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppointmentsTest extends TestCase
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

    /**
     * A basic test example.
     *
     * @test
     */
    public function can_access_staff()
    {
        $staff = factory(App\Staff::class)->create();
        $appointment = factory(App\Appointment::class)->create(['staff_id' => $staff->id]);

        $this->assertEquals($staff->id, $appointment->staff->id);
    }

    /**
     * A basic test example.
     *
     * @test
     */
    public function can_access_location()
    {
        $location = factory(App\Location::class)->create();
        $appointment = factory(App\Appointment::class)->create(['location_id' => $location->id]);

        $this->assertEquals($location->id, $appointment->location->id);
    }
}
