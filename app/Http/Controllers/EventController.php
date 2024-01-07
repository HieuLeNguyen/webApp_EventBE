<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('organizer')->orderBy('date', 'asc')->get();
        // dd($events);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:events,slug',
                'date' => 'required|date_format:Y-m-d',
            ],
            [
                'required' => ':attribute không được để trống',
                'regex' => ':attribute chỉ chứa các ký
                tự a-z, 0-9 và "-"',
                'unique' => ':attribute đã được sử dụng',
            ],
            [
                'name' => 'Tên',
                'date' => 'Ngày',
            ]
        );
        $request->merge(['organizer_id'=> session('id_user')]);
        Event::create($request->all());
        return redirect('/events/'.$request->slug.'/detail')->with('success','Tạo sự mới kiện thành công');
    }

    /**
     * Display the specified resource. {detail}
     */
    public function show( $slug)
    {
        // dd($slug);
        $event = Event::with('organizer','tickets', 'channels.rooms.sessions')
        ->where('slug',$slug)
        ->first();


        $tickets = $event->event_ticket;
        $channels = $event->channels;
        $rooms = $channels->flatMap->rooms;
        $sessions = $rooms->flatMap->sessions;

        session([
            'name_event' => $event->name,
            'date_event' => $event->date,
            'slug_event' => $event->slug,
        ]);
        return view('events.detail', compact('tickets','channels','rooms','sessions','slug'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $slug)
    {
        // $event = Event::with('organizer')->where('slug', $slug)->fisrt();
        return view('events.edit');
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(Request $request,  $slug)
    {
        $event = Event::with('organizer')->where('slug', $slug)->fisrt();
        $request->validate(
            [
                'name' => 'required|string: 255',
                'slug' => 'required|regex:/^[a-z0-9-]+$/|unique: events, slug,'.$event->id,
                'date' => 'required|date_format:Y-m-d',
            ],
            [
                'required' => ':attribute không được để trống',
                'regex' => ':attribute chỉ chứa các ký
                tự a-z, 0-9 và '-'',
                'unique' => ':attribute đã được sử dụng',
            ],
            [
                'name' => 'Tên',
                'date' => 'Ngày',
            ]
        );

        $event->fill($request->all());
        $event->save();
        return redirect('/events/'.$request->slug.'/detail')->with('success','Sửa sự kiện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
    }

    public function getEvents(){
        $events = Event::with('organizer')
        ->where('date', '>=', date('Y-m-d'))
        ->orderBy('date', 'asc')
        ->get();
        return response()->json(["events" => $events]);
    }

    public function detailEvent($organizer_slug, $event_slug) {
        $infOr = Organizer::where('slug', $organizer_slug)->first();
        if(!$infOr) return response()->json(["message"=>"Không tìm thấy nhà tổ chức"], 404);

        $infEv = Event::with(['channels.rooms.sessions', 'tickets'])
        ->where([
            'slug' => $event_slug,
            'organizer_id' => $infOr->id
        ])->first();

        if(!$infEv) return response()->json(["message"=>"không tìm thấy sự kiện"], 404);

        return response()->json($infEv);
    }
}

// URL: /api/v1/organizers/{organizer-slug}/events/{event-slug}
// Method: GET
// Header:
// Body: -
// Response
// Nếu thành công
// Header: Response code: 200
// Body: {"id": 1, "name": "someText", "slug": "some-text",
// "date": "2019-08-15", "channels": [{"id": 1, "name": "someText",
// "rooms": [{"id": 1, "name": "someText", "sessions": [{"id": 1,
// "title": "someText", "description": "someText", "speaker": "someText",
// "start": "2019-08-15 10:00:00", "end": "2019-08-15 10:45:00", "type":
// "workshop", "cost": 50|null}]}]}], "tickets": [{"id": 1, "name":
// "someText", "description": "Sẵn có đến ngày 30 – 11 - 2019"|null,
// "cost": 199.99, "available": true}]}
// Nếu sự kiện không tồn tại hoặc không được tạo bởi nhà tổ chức
// Header: Response code: 404
// Body: {"message": "Không tìm thấy sự kiện"}
// Nếu nhà tổ chức không tồn tại
// Header: Response code: 404
// Body: {"message": "Không tìm thấy nhà tổ chức"}
