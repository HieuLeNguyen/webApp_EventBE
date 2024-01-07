<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Session;
use App\Models\Event;
use App\Models\SessionRegistration;



use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // $event = Event::with('channels.rooms.sessions')->where('slug', $slug)->first();
        // $sessions = $event->channels->flatMap->rooms->flatMap->sessions;
        // $id = $sessions->pluck('id');
        // $sessions_title = $sessions->pluck('title');
        // $rooms_capacity = $sessions->pluck('room.capacity');

        // $rgCount = SessionRegistration::selectRaw('session_id, COUNT(*) as count')
        // ->whereIn('session_id', $id)
        // ->groupBy('session_id')
        // ->get()
        // ->pluck('count', 'session_id')
        // ->union($id->flip()->map(function (){
        //     return 0;
        // }))->sortKeys();

        $event = Event::with('channels.rooms.sessions')->where('slug', $slug)->first();
        $sessions = $event->channels->flatMap->rooms->flatMap->sessions;
        $id = $sessions->pluck('id');
        $rooms_capacity = $sessions->pluck('room.capacity');
        $sessions_title = $sessions->pluck('title');

        $rgCount = SessionRegistration::selectRaw('session_id, COUNT(*) as count')
        ->whereIn('session_id', $id)
        ->groupBy('session_id')
        ->get()
        ->pluck('count', 'session_id')
        ->union($id->flip()->map(function(){
            return 0;
        }))->sortKeys();



        return view('reports.index', compact('sessions_title', 'rooms_capacity', 'rgCount'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
    }
}
