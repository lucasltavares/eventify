<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventPhotoController extends Controller
{
    public function store(Request $request, Event $event): RedirectResponse
    {
        abort_unless($event->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'photos' => ['required', 'array', 'min:1', 'max:12'],
            'photos.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:4096'],
        ]);

        $nextSortOrder = (int) $event->photos()->max('sort_order');

        foreach ($validated['photos'] as $photo) {
            $nextSortOrder++;

            $event->photos()->create([
                'image_path' => $photo->store('events/gallery', 'public'),
                'sort_order' => $nextSortOrder,
            ]);
        }

        return back()->with('success', 'Fotos adicionadas à galeria do evento.');
    }

    public function destroy(Event $event, EventPhoto $photo): RedirectResponse
    {
        abort_unless($event->user_id === Auth::id() && $photo->event_id === $event->id, 403);

        $photo->delete();

        return back()->with('success', 'Foto removida da galeria.');
    }
}
