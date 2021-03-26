<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $valid = $request->validate([
            'event_name' => ['required', 'string'],
            'event_type' => ['required', 'string'],
            'event_date' => ['required', 'int'],
            'event_sum' => ['required', 'int']
        ]);
        $valid['user_id']=1;
        Event::factory()->create($valid);
    }
    public function take(){
        $events = DB::table('events')
            ->where('user_id', 1)
            ->get();
        return $events;
    }

}
