<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AttendeeTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    
    /**
     * A basic test example.
     *
     * @test
     */
    public function test_can_access_appointments()
    {
        $attendee = factory(App\Attendee::class)->create(['name' => 'Test Attendee']);

        $appointment = factory(App\Appointment::class)->create(['attendee_id' => $attendee->id]);

        $this->assertContains($appointment->id, $attendee->appointments->pluck('id'));
    }
}
