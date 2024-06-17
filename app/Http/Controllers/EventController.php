<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())->get(['id', 'title', 'start_date as start', 'end_date as end']);

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_date',
        ]);

        $event = new Event();
        $event->title = $validatedData['title'];
        $event->start_date = $validatedData['start_date'];
        $event->end_date = $validatedData['end_date'];
        $event->user_id = auth()->id();
        $event->save();

        return response()->json(['message' => 'Event created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_date',
        ]);

        $event = Event::findOrFail($id);
        $event->title = $validatedData['title'];
        $event->start_date = $validatedData['start_date'];
        $event->end_date = $validatedData['end_date'];
        $event->save();

        return response()->json(['message' => 'Event updated successfully'], 200);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
