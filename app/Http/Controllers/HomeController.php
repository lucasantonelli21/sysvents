<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {

        $events = Event::orderBy('id', 'desc')->paginate(10);

        $data = [
            "events" => $events
        ];


        return view('home', $data);
    }

}
