<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventQuestion;
use App\Models\Rsvp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EventSupportFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirmed_guest_can_open_private_support_channel_and_submit_question(): void
    {
        $event = $this->createEvent();

        $this->post("/e/{$event->slug}/rsvp", [
            'name' => 'Ana',
            'email' => 'ana@example.com',
            'guests_count' => 1,
        ])->assertRedirect();

        $rsvp = Rsvp::first();

        $this->assertNotNull($rsvp->support_token);

        $this->post("/support/{$rsvp->support_token}", [
            'question' => 'Vai ter estacionamento no local?',
        ])->assertSessionHas('success');

        $this->assertDatabaseHas('event_questions', [
            'event_id' => $event->id,
            'rsvp_id' => $rsvp->id,
            'question' => 'Vai ter estacionamento no local?',
        ]);
    }

    public function test_event_owner_can_answer_guest_question(): void
    {
        $event = $this->createEvent();

        $rsvp = Rsvp::create([
            'event_id' => $event->id,
            'name' => 'Ana',
            'email' => 'ana@example.com',
            'status' => Rsvp::STATUS_CONFIRMED,
            'guests_count' => 1,
        ]);

        $question = EventQuestion::create([
            'event_id' => $event->id,
            'rsvp_id' => $rsvp->id,
            'question' => 'Qual o melhor horário para chegar?',
        ]);

        $this->actingAs($event->user)
            ->post("/events/{$event->id}/questions/{$question->id}/reply", [
                'answer' => 'Chegue 30 minutos antes para entrar com calma.',
            ])
            ->assertSessionHas('success');

        $this->assertSame(
            'Chegue 30 minutos antes para entrar com calma.',
            $question->fresh()->answer,
        );
        $this->assertNotNull($question->fresh()->answered_at);
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
            'title' => 'Support Event',
            'description' => 'Description',
            'event_date' => today()->addDay()->toDateString(),
            'location' => 'Sao Paulo',
            'slug' => Str::slug(Str::uuid()),
            'is_active' => true,
            'status' => Event::STATUS_SCHEDULED,
        ], $attributes));
    }
}
