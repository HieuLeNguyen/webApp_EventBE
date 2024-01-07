<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Organizer extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    public $timestamps = false;

    protected $guarded = [];


    public function events(){
        return $this->hasMany(Event::class);
    }

    public function getAuthPassword()
    {
        return $this->password_hash; // Thay 'password_hash' bằng tên cột chứa mật khẩu trong model của bạn
    }

}
