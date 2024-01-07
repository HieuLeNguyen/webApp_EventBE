<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
// use Auth;

class OrganizerController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        
        // if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        // {
        //     return redirect()->intended('/events');
        // }
        // if(auth()->attempt(request()->only(['email', 'password']))){
        //     return redirect()->intended('/events');
        // }

        // return redirect()->back()->withErrors(['message'=>'Tên đăng nhập hoặc mật khẩu không chính xác']);
        $checkInf = Organizer::where([
            'email' => $request->email,
            'password_hash' => $request->password,
        ])->first();
        // dd($checkInf);
        if(!$checkInf) return redirect('/')->withErrors(['message'=>'Tên đăng nhập hoặc mật khẩu không chính xác']);
        session([
            'id_user' => $checkInf->id,
            'name_user' => $checkInf->name
        ]);
        return redirect('/events');
    }


}
