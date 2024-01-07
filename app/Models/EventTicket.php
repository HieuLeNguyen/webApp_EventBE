<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
    
    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function registrations(){
        return $this->hasMany(Registration::class);
    }

}
