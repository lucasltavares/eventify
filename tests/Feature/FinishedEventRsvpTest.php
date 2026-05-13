<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class FinishedEventRsvpTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_event_page_marks_overdue_events_as_finished(): void
    {
        $event = $this->createEvent([
            'event_date' => today()->subDay()->toDateString(),
            'status' => Event::STATUS_SCHEDULED,
        ]);

        $this->get("/e/{$event->slug}")
            ->assertOk();

        $this->assertSame(Event::STATUS_FINISHED, $event->fresh()->status);
    }

    public function test_finished_events_do_not_accept_new_rsvps(): void
    {
        $event = $this->createEvent([
            'event_date' => today()->subDay()->toDateString(),
            'status' => Event::STATUS_SCHEDULED,
        ]);

        $this->post("/e/{$event->slug}/rsvp", [
            'name' => 'Late Guest',
            'guests_count' => 2,
        ])
            ->assertSessionHasErrors('event');

        $this->assertSame(Event::STATUS_FINISHED, $event->fresh()->status);
        $this->assertDatabaseCount('rsvps', 0);
    }

    private function createEvent(array $attributes = []): Event
    {
        $user = User::create([
            'name' => 'Owner',
            'email' => Str::uuid().'@example.com',
            'password' => bcrypt('password'),
        ]);

        return Event::create(array_merge([
            'user_id' => $user->id,
            'title' => 'Test Event',
            'description' => 'Description',
            'event_date' => today()->addDay()->toDateString(),
            'location' => 'Sao Paulo',
            'slug' => Str::slug(Str::uuid()),
            'is_active' => true,
            'status' => Event::STATUS_SCHEDULED,
        ], $attributes));
    }
}
