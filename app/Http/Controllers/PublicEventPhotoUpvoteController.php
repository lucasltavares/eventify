<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicEventPhotoUpvoteController extends Controller
{
    public function store(Request $request, string $slug, EventPhoto $photo): RedirectResponse
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        abort_unless($photo->event_id === $event->id, 404);

        $guestToken = $this->guestToken($request);

        $photo->upvotes()->firstOrCreate([
            'guest_token' => $guestToken,
        ]);

        return back()->with('success', 'Voto registrado na foto.');
    }

    private function guestToken(Request $request): string
    {
        $token = $request->session()->get('gallery_guest_token');

        if (! $token) {
            $token = Str::uuid()->toString();
            $request->session()->put('gallery_guest_token', $token);
        }

        return $token;
    }
}
