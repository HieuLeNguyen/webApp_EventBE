<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Attendee;

use Illuminate\Http\Request;

class RegistrationController extends Controller
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
    public function registration(Request $request, $organizer_slug, $event_slug)
    {


        // $checkInf = Attendee::where('login_token', $request->token)->first();
        // if(!$checkInf) return response()->json(["message" => "Người dùng chưa đăng nhập"], 401);

        // $checkRegitrated = Registration::with('attendee')->where('attendee_id', $checkInf->id)->all();
        // if($checkRegitrated) return response()->json(["message" => "Người dùng đã đăng ký"], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $registrated = Attendee::with('registrations.ticket.event.organizer')
        ->where('login_token', $request->token)
        ->first();
        $registrations = $registrated->registrations->map(function($registraion){
            return [
                'event' => $registraion->ticket->event
            ];
        });
        if (!$registrated || $registrations->isEmpty()) {
            return response()->json(["message"=>"Người dùng chưa đăng nhập"], 401);
        }
        return response()->json(["registraions"=>$registrations]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //{"registrations": [{"event": {"id": 1, "name": "someText",
        // "slug": "some-text", "date": "2019-08-15", "organizer": {"id": 1, "name":
        //     "someText", "slug": "some-text"}}, "session_ids": [1, 2, 3]}]}
        //     Nếu người dùng chưa đăng ký hoặc token không hợp lệ
        //     Header: Response code: 401
        //     Body: {"message": "Người dùng chưa đăng nhập"
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
