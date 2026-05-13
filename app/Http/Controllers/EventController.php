<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(): Response
    {
        Event::syncStatuses();

        $events = Auth::user()->events()
            ->withCount(['rsvps as confirmed_rsvps_count' => function ($query) {
                $query->where('status', 'confirmed');
            }])
            ->orderBy('event_date', 'desc')
            ->paginate(10);

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'event_time' => ['nullable', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,gif', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('events/covers', 'public');
        }

        $event = Auth::user()->events()->create($validated);

        return redirect()->route('events.show', $event);
    }

    public function show(Event $event): Response
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        Event::syncStatuses();
        $event->refresh();

        $event->load([
            'rsvps' => function ($query) {
                $query->where('status', 'confirmed')->orderBy('created_at', 'desc');
            },
            'photos' => function ($query) {
                $query
                    ->withCount(['upvotes', 'comments'])
                    ->with('comments');
            },
        ]);

        $questionsQuery = $event->questions()->with('rsvp');
        $feedbacksQuery = $event->feedbacks()->with('rsvp')->orderByDesc('created_at');

        $questions = $questionsQuery
            ->paginate(6, ['*'], 'questions_page')
            ->withQueryString();

        $feedbacks = $feedbacksQuery
            ->paginate(6, ['*'], 'feedback_page')
            ->withQueryString();

        $questionMetrics = [
            'total' => $event->questions()->count(),
            'pending' => $event->questions()->whereNull('answer')->count(),
            'answered' => $event->questions()->whereNotNull('answer')->count(),
        ];

        $feedbackMetrics = [
            'total' => $event->feedbacks()->count(),
            'responded' => $event->feedbacks()->whereNotNull('submitted_at')->count(),
            'emailed' => $event->feedbacks()->whereNotNull('invitation_sent_at')->count(),
            'average_rating' => round((float) ($event->feedbacks()->whereNotNull('overall_rating')->avg('overall_rating') ?? 0), 1),
            'recommendation_rate' => (int) round(
                $event->feedbacks()->whereNotNull('submitted_at')->count() > 0
                    ? ($event->feedbacks()->where('would_recommend', true)->count() / $event->feedbacks()->whereNotNull('submitted_at')->count()) * 100
                    : 0
            ),
        ];

        return Inertia::render('Events/Show', [
            'event' => $event,
            'questions' => $questions,
            'feedbacks' => $feedbacks,
            'questionMetrics' => $questionMetrics,
            'feedbackMetrics' => $feedbackMetrics,
        ]);
    }

    public function edit(Event $event): Response
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        Event::syncStatuses();
        $event->refresh();

        return Inertia::render('Events/Edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,gif', 'max:2048'],
            'remove_cover_image' => ['boolean'],
        ]);

        if ($request->boolean('remove_cover_image')) {
            if ($event->cover_image) {
                \Storage::disk('public')->delete($event->cover_image);
            }
            $validated['cover_image'] = null;
        } elseif ($request->hasFile('cover_image')) {
            if ($event->cover_image) {
                \Storage::disk('public')->delete($event->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('events/covers', 'public');
        }

        unset($validated['remove_cover_image']);

        $event->update($validated);

        return redirect()->route('events.show', $event);
    }

    public function destroy(Event $event): RedirectResponse
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $event->delete();

        return redirect()->route('events.index');
    }

    public function copyLink(Event $event): \Illuminate\Http\JsonResponse
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        return response()->json([
            'url' => $event->public_url,
        ]);
    }
}
