<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class StaffTest extends TestCase
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
        $staff = factory(App\Staff::class)->create();

        $appointment = factory(App\Appointment::class)->create(['staff_id' => $staff->id]);

        $this->assertContains($staff->id, $staff->appointments->pluck('id'));
    }
}
