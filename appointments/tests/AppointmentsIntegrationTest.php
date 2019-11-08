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
    public function returns_404_if_resource_doesnt_exist()
    {
        $user = factory(App\User::class)->create();

        $response = $this->actingAs($user)->call('GET', route('appointments.show', ['id' => 9999]));

        $this->assertEquals(404, $response->status());
    }

    /**
     * @test
     */
    public function can_view_list_of_appointments()
    {
        $appointments = factory(App\Appointment::class, 3)->create();
        $user = factory(App\User::class)->create();

        $response = $this->actingAs($user)
            ->call('GET', route('appointments.index'));

        $decoded = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('appointments', $decoded);

        foreach($appointments as $appointment) {
            $this->assertContains(['appointment_id' => $appointment->id], $decoded['appointments']);
        }
    }
}
