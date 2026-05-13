<?php

namespace Tests\Feature;

use App\Mail\EventFeedbackInvitationMail;
use App\Models\Event;
use App\Models\EventFeedback;
use App\Models\Rsvp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class EventFeedbackFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_finished_events_generate_feedback_links_for_confirmed_rsvps(): void
    {
        Mail::fake();

        $event = $this->createEvent([
            'event_date' => today()->subDay()->toDateString(),
            'status' => Event::STATUS_SCHEDULED,
        ]);

        $rsvp = Rsvp::create([
            'event_id' => $event->id,
            'name' => 'Ana',
            'email' => 'ana@example.com',
            'status' => Rsvp::STATUS_CONFIRMED,
            'guests_count' => 1,
        ]);

        Event::syncStatuses();

        $feedback = EventFeedback::where('rsvp_id', $rsvp->id)->first();

        $this->assertNotNull($feedback);
        $this->assertSame(Event::STATUS_FINISHED, $event->fresh()->status);
        $this->assertNotNull($feedback->invitation_sent_at);
        Mail::assertSent(EventFeedbackInvitationMail::class);
    }

    public function test_participant_can_submit_feedback_with_tokenized_link(): void
    {
        $event = $this->createEvent([
            'event_date' => today()->subDay()->toDateString(),
            'status' => Event::STATUS_FINISHED,
        ]);

        $rsvp = Rsvp::create([
            'event_id' => $event->id,
            'name' => 'Ana',
            'email' => 'ana@example.com',
            'status' => Rsvp::STATUS_CONFIRMED,
            'guests_count' => 1,
        ]);

        $feedback = EventFeedback::create([
            'event_id' => $event->id,
            'rsvp_id' => $rsvp->id,
            'token' => Str::random(40),
            'recipient_name' => 'Ana',
            'recipient_email' => 'ana@example.com',
        ]);

        $this->post("/feedback/{$feedback->token}", [
            'overall_rating' => 5,
            'organization_rating' => 4,
            'experience_rating' => 5,
            'highlight' => 'A recepção foi excelente.',
            'improvement' => 'Mais tempo para networking.',
            'would_recommend' => true,
        ])->assertSessionHas('success');

        $this->assertNotNull($feedback->fresh()->submitted_at);
        $this->assertSame(5, $feedback->fresh()->overall_rating);
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
            'title' => 'Feedback Event',
            'description' => 'Description',
            'event_date' => today()->addDay()->toDateString(),
            'location' => 'Sao Paulo',
            'slug' => Str::slug(Str::uuid()),
            'is_active' => true,
            'status' => Event::STATUS_SCHEDULED,
        ], $attributes));
    }
}
