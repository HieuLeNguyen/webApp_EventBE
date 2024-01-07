<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
    
    public function ticket(){
        return $this->belongsTo(EventTicket::class);
    }

    public function registration(){
        return $this->belongsTo(Registration::class);
    }

    public function attendee(){
        return $this->belongsTo(Attendee::class);
    }
    
    // event?

}
