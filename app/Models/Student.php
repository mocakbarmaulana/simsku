<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function getCutNameAttribute($value){
        if (strlen($value) > 20) {
            return substr($value,0,30) . '...';
        } else {
            return $value;
        }
    }

    public function orders(){
        $this->hasMany(Order::class);
    }
}