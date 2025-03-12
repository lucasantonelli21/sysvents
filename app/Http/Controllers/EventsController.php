<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index() {

        return view('events.index');
    }

    public function showEvent($id) {

        $event = Event::findOrFail($id);

        $data = [
            'event' => $event
        ];

        return view('events.event', $data);
    }

}
