<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events =  Event::where('user_id', auth()->user()->id)
        ->orderBy('is_complete', 'asc')
        ->orderBy('created_at', 'desc')
        ->get();
        //dd($events);
        $eventsCompleted = Event::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();
        return view('event.index', compact('events', 'eventsCompleted'));
    }
    public function create()
    {
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('event.create', compact('categories'));
    }
    public function edit(Event $event)
    {
        // CODE AFTER REFACTORINGS
        $categories = Category::where('user_id', auth()->user()->id)->get();
        if (auth()->user()->id == $event->user_id) {
            return view('event.edit', compact(['event', 'categories']));
        }
        return redirect()->route('event.index')->with('danger', 'You are not authorized to edit this event!');
    }
    public function description(Event $event)
    {
        // CODE AFTER REFACTORINGS
        $categories = Category::where('user_id', auth()->user()->id)->get();
        if (auth()->user()->id == $event->user_id) {
            return view('event.description', compact(['event', 'categories']));
        }
        return redirect()->route('event.index')->with('danger', 'You are not authorized to view this event!');
    }
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event' => 'required|max:255',
            'category_id',
            'jumlah' => 'required',
        ]);

        $event->update([
            'event' => ucfirst($request->event),
            'category_id' => $request->category_id,
            'jumlah' => $request->jumlah,
        ]);
        return redirect()->route('event.index')->with('success', 'Event Updated Successfully!');
    }

    public function complete(event $event)
    {
        if (auth()->user()->id == $event->user_id) {
            $event->update([
                'is_complete' => true,
            ]);
            return redirect()->route('event.index')->with('success', 'Event Completed Successfully!');
        } else {
            return redirect()->route('event.index')->with('danger', 'You are not authorized to complete this event!');
        }
    }
    public function uncomplete(event $event)
    {
        if (auth()->user()->id == $event->user_id) {
            $event->update([
                'is_complete' => false,
            ]);
            return redirect()->route('event.index')->with('success', 'Event Uncompleted Successfully!');
        } else {
            return redirect()->route('event.index')->with('danger', 'You are not authorized to uncomplete this event!');
        }
    }
    public function destroy(event $event)
    {
        if (auth()->user()->id == $event->user_id) {
            $event->delete();
            return redirect()->route('event.index')->with('success', 'Event Deleted Successfully!');
        } else {
            return redirect()->route('event.index')->with('danger', 'You are not authorized to delete this event!');
        }
    }
    public function destroyCompleted()
    {
        // get all events for current user where is_completed is true
        $eventsCompleted = event::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();
        foreach ($eventsCompleted as $event) {
            $event->delete();
        }
        // dd($eventsCompleted);
        return redirect()->route('event.index')->with('success', 'All completed events deleted successfully!');
    }
    public function store(Request $request, event $event)
    {
        $request->validate([
            'event' => 'required|max:255',
            'category_id',
            'jumlah' => 'required',
            'description',
            ]);

        // Eloquent Way - Readable
        $event = Event::create([
            'event' => ucfirst($request->event),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'jumlah' => $request->jumlah,
            'description' => $request->description,
            ]);
        
        return redirect()->route('event.index')->with('success', 'Event Created Successfully!');
    }
}