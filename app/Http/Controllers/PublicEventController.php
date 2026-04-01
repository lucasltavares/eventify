<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PublicEventController extends Controller
{
    public function show(string $slug): Response
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $confirmedRsvps = $event->rsvps()
            ->where('status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $stats = [
            'total_guests' => $event->rsvps()->where('status', 'confirmed')->sum('guests_count'),
            'total_responses' => $event->rsvps()->where('status', 'confirmed')->count(),
        ];

        return Inertia::render('Public/Event', [
            'event' => $event,
            'rsvps' => $confirmedRsvps,
            'stats' => $stats,
        ]);
    }

    public function rsvp(Request $request, string $slug): RedirectResponse
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:500'],
            'guests_count' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $event->rsvps()->create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'guests_count' => $validated['guests_count'] ?? 1,
            'status' => Rsvp::STATUS_CONFIRMED,
        ]);

        return redirect()->back()->with('success', 'Obrigado por confirmar sua presença!');
    }
}
