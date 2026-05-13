<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Event;
use App\Models\EventPhotoUpvote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PublicEventController extends Controller
{
    public function show(string $slug): Response
    {
        Event::syncStatuses();

        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'photos' => function ($query) {
                    $query
                        ->withCount(['upvotes', 'comments'])
                        ->with('comments');
                },
            ])
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

        $guestToken = request()->session()->get('gallery_guest_token');

        if (! $guestToken) {
            $guestToken = Str::uuid()->toString();
            request()->session()->put('gallery_guest_token', $guestToken);
        }

        $upvotedPhotoIds = EventPhotoUpvote::query()
            ->whereIn('event_photo_id', $event->photos->pluck('id'))
            ->where('guest_token', $guestToken)
            ->pluck('event_photo_id')
            ->values();

        return Inertia::render('Public/Event', [
            'event' => $event,
            'rsvps' => $confirmedRsvps,
            'stats' => $stats,
            'upvotedPhotoIds' => $upvotedPhotoIds,
        ]);
    }

    public function rsvp(Request $request, string $slug): RedirectResponse
    {
        Event::syncStatuses();

        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        if ($event->isFinished()) {
            return redirect()
                ->back()
                ->withErrors([
                    'event' => 'As confirmacoes para este evento foram encerradas.',
                ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:500'],
            'guests_count' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $rsvp = $event->rsvps()->create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'guests_count' => $validated['guests_count'] ?? 1,
            'status' => Rsvp::STATUS_CONFIRMED,
        ]);

        return redirect()
            ->route('support.show', $rsvp->support_token)
            ->with('success', 'Presença confirmada. Use este canal para tirar dúvidas diretamente com o organizador.');
    }
}
