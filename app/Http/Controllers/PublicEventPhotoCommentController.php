<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicEventPhotoCommentController extends Controller
{
    public function store(Request $request, string $slug, EventPhoto $photo): RedirectResponse
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        abort_unless($photo->event_id === $event->id, 404);

        $validated = $request->validate([
            'author_name' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:800'],
        ]);

        $photo->comments()->create($validated);

        return back()->with('success', 'Comentário publicado na foto.');
    }
}
