<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {

        $events = Event::all();

        $data = [
            "events" => $events
        ];


        return view('home', $data);
    }

}
