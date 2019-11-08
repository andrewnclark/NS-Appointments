<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LocationTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    
    /**
     * A basic test example.
     *
     * @test
     */
    public function can_access_appointments()
    {
        $location = factory(App\Location::class)->create(['name' => 'Test Location']);

        $appointments = factory(App\Appointment::class, 3)->create(['location_id' => $location->id]);

        foreach($appointments as $appointment) {
            $this->assertContains($appointment->id, $location->appointments->pluck('id'));
        }

        $this->assertCount(3, $location->appointments);
    }
}
