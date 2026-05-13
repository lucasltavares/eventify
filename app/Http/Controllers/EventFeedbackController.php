<?php

namespace App\Http\Controllers;

use App\Models\EventFeedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventFeedbackController extends Controller
{
    public function show(string $token): Response
    {
        \App\Models\Event::syncStatuses();

        $feedback = EventFeedback::with('event')
            ->where('token', $token)
            ->firstOrFail();

        abort_unless($feedback->event->isFinished(), 404);

        return Inertia::render('Public/Feedback', [
            'feedback' => [
                'token' => $feedback->token,
                'recipient_name' => $feedback->recipient_name,
                'submitted_at' => $feedback->submitted_at,
                'overall_rating' => $feedback->overall_rating,
                'organization_rating' => $feedback->organization_rating,
                'experience_rating' => $feedback->experience_rating,
                'highlight' => $feedback->highlight,
                'improvement' => $feedback->improvement,
                'would_recommend' => $feedback->would_recommend,
            ],
            'event' => [
                'title' => $feedback->event->title,
                'event_date' => $feedback->event->event_date,
                'location' => $feedback->event->location,
                'cover_image_url' => $feedback->event->cover_image_url,
            ],
        ]);
    }

    public function store(Request $request, string $token): RedirectResponse
    {
        \App\Models\Event::syncStatuses();

        $feedback = EventFeedback::with('event')
            ->where('token', $token)
            ->firstOrFail();

        abort_unless($feedback->event->isFinished(), 404);

        if ($feedback->submitted_at) {
            return redirect()->back()->with('success', 'Sua avaliação já foi registrada. Obrigado.');
        }

        $validated = $request->validate([
            'overall_rating' => ['required', 'integer', 'between:1,5'],
            'organization_rating' => ['required', 'integer', 'between:1,5'],
            'experience_rating' => ['required', 'integer', 'between:1,5'],
            'highlight' => ['nullable', 'string', 'max:1000'],
            'improvement' => ['nullable', 'string', 'max:1000'],
            'would_recommend' => ['required', 'boolean'],
        ]);

        $feedback->update([
            ...$validated,
            'submitted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Obrigado por avaliar o evento.');
    }
}
