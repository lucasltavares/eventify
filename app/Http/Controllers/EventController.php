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
        ]);

        $event = Auth::user()->events()->create($validated);

        return redirect()->route('events.show', $event);
    }

    public function show(Event $event): Response
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $event->load(['rsvps' => function ($query) {
            $query->where('status', 'confirmed')->orderBy('created_at', 'desc');
        }]);

        return Inertia::render('Events/Show', [
            'event' => $event,
        ]);
    }

    public function edit(Event $event): Response
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

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
        ]);

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
