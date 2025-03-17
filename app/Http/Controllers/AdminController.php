<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::soldTickets($request)->get();
        $eventsName = [];
        if($request->events) {
            foreach ($request->events as $event) {
                $eventProps = Event::select('id', 'name as text')->where('id', $event)->first();
                $eventsName[$eventProps->id] = $eventProps->text;
            }
        }
        return view('admin.dashboard', ["events" => $events, "eventsName" => $eventsName]);
    }
}
