<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
    
    public function organizer(){
        return $this->belongsTo(Organizer::class)->select('id', 'name', 'email');
    }

    public function tickets(){
        return $this->hasMany(EventTicket::class);
    }

    public function channels(){
        return $this->hasMany(Channel::class);
    }


    public function registrations(){
        return $this->hasManyThrough(Registration::class, EventTicket::class, 'event_id', 'ticket_id');
    }
}
