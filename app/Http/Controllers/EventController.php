<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->user()->id)
        ->orderBy('is_complete', 'asc')
        ->orderBy('created_at', 'desc')
        ->get();

        // dd($events);
        return view('event.index', compact('events'));
    }
    public function create()
    {
        return view('event.create');
    }
    public function edit()
    {
        return view('event.edit');
    }
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'event' => 'required|max:255',
            ]);

        $event = Event::create([
            'event' => ucfirst($request->event),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('event.index')->with('success', 'Event created successfully!');
    }
}