<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')->get();
        return view('event.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:10|max:150',
            'description' => 'required',
            'date' => 'required|date'
        ]);

        // user_id -> Logged in user id
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('event.index')->with(['message' => 'Event Created']);
    }
}
