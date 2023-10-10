<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name','country','state'];

    public function state(){
        return $this->belongsTo(State::class); 
    }

    public function country(){
        return $this->belongsTo(Country::class); 
    }
}
