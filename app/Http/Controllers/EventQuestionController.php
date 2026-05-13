<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventQuestionController extends Controller
{
    public function reply(Request $request, Event $event, EventQuestion $question): RedirectResponse
    {
        if ($event->user_id !== Auth::id() || $question->event_id !== $event->id) {
            abort(403);
        }

        $validated = $request->validate([
            'answer' => ['required', 'string', 'max:2000'],
        ]);

        $question->update([
            'answer' => $validated['answer'],
            'answered_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Resposta publicada para o participante.');
    }
}
