<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GuestSupportController extends Controller
{
    public function show(string $token): Response
    {
        $rsvp = Rsvp::with('event')->where('support_token', $token)->firstOrFail();

        abort_unless($rsvp->status === Rsvp::STATUS_CONFIRMED, 404);

        $questions = $rsvp->questions()
            ->paginate(5, ['*'], 'support_page')
            ->withQueryString()
            ->through(fn ($question) => [
                'id' => $question->id,
                'question' => $question->question,
                'answer' => $question->answer,
                'answered_at' => $question->answered_at,
                'created_at' => $question->created_at,
            ]);

        return Inertia::render('Public/Support', [
            'event' => [
                'title' => $rsvp->event->title,
                'event_date' => $rsvp->event->event_date,
                'location' => $rsvp->event->location,
                'cover_image_url' => $rsvp->event->cover_image_url,
            ],
            'rsvp' => [
                'name' => $rsvp->name,
                'support_token' => $rsvp->support_token,
                'email' => $rsvp->email,
                'phone' => $rsvp->phone,
            ],
            'questions' => $questions,
            'questionMetrics' => [
                'total' => $rsvp->questions()->count(),
                'answered' => $rsvp->questions()->whereNotNull('answer')->count(),
                'pending' => $rsvp->questions()->whereNull('answer')->count(),
            ],
        ]);
    }

    public function store(Request $request, string $token): RedirectResponse
    {
        $rsvp = Rsvp::with('event')->where('support_token', $token)->firstOrFail();

        abort_unless($rsvp->status === Rsvp::STATUS_CONFIRMED, 404);

        $validated = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
        ]);

        $rsvp->questions()->create([
            'event_id' => $rsvp->event_id,
            'question' => $validated['question'],
        ]);

        return redirect()->back()->with('success', 'Sua dúvida foi enviada ao organizador.');
    }
}
