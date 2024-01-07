<?php

namespace App\Http\Controllers;

use App\Models\Attendee;

use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $checkInf = Attendee::where([
            'lastname' => $request->lastname,
            'registration_code' => $request->registration_code,
        ])->first();

        if(!$checkInf) return response()->json(["message"=>"Đăng nhập không hợp lệ"], 401);
        
        $token = md5($checkInf->username);
        $checkInf->login_token = $token;
        $checkInf->save();

        return response()->json([
            "firstname" => $checkInf->firstname,
            "lastname" => $checkInf->lastname,
            "username" => $checkInf->username,
            "email" => $checkInf->email,
            "token" => $checkInf->login_token
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout(Request $request)
    {
        $checkInf = Attendee::where('login_token', $request->token)->first();
        if(!$checkInf) return response()->json(["message"=>"Token Không hợp lệ"], 401);
        $checkInf->login_token = '';
        $checkInf->save();
        return response()->json(["message"=>"Đăng xuất thành công"]);
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
    public function show(Attendee $attendee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendee $attendee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendee $attendee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendee $attendee)
    {
        //
    }
}
