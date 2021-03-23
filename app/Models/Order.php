<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function courses(){
    //     return $this->hasMany(Course::class, 'id');
    // }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function payments(){
        return $this->hasOne(Payment::class);
    }

    // public function courses(){
    //     return $this->hasManyThrough(Course::class, Student::class);
    // }

}