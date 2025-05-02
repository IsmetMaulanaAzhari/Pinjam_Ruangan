<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display the calendar view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('calendar');
    }

    /**
     * Fetch all calendar events as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function events()
    {
        $events = CalendarEvent::all();
        return response()->json($events);
    }

    /**
     * Store a new calendar event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $event = CalendarEvent::create($validated);

        return response()->json($event, 201);
    }
}
