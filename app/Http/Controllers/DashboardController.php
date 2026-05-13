<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): Response
    {
        \App\Models\Event::syncStatuses();

        $user = Auth::user();
        
        $stats = [
            'total_events' => $user->events()->count(),
            'upcoming_events' => $user->events()->where('event_date', '>=', now()->toDateString())->count(),
            'total_rsvps' => $user->events()->withCount('rsvps')->get()->sum('rsvps_count'),
            'confirmed_rsvps' => $user->events()->withCount([
                'rsvps as confirmed_rsvps_count' => function ($query) {
                    $query->where('status', 'confirmed');
                }
            ])->get()->sum('confirmed_rsvps_count'),
        ];

        $recentEvents = $user->events()
            ->withCount(['rsvps as confirmed_rsvps_count' => function ($query) {
                $query->where('status', 'confirmed');
            }])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return Inertia::render('Dashboard/Index', [
            'stats' => $stats,
            'recentEvents' => $recentEvents,
        ]);
    }
}
