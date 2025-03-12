<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $events = Event::soldTickets()->get();
        return view('admin.dashboard', ["events" => $events]);
    }

}
