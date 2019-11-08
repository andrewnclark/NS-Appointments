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
    public function can_view_an_appointment()
    {
        $appointment = factory(App\Appointment::class)->create();
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->get(route('appointments.show', ['id' => $appointment->id]))
            ->seeJson(['appointment_id' => $appointment->id]);
    }

    /**
     * @test
     */
    public function can_view_list_of_appointments()
    {
        $appointment = factory(App\Appointment::class)->create();
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->get(route('appointments.index'))
            ->seeJson(['appointment_id' => $appointment->id]);
    }
}
