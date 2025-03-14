<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){
        $events = Event::soldTickets($request)->get();
        return view('admin.dashboard', ["events" => $events]);
    }

}
