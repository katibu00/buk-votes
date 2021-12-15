<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    // public function getStartDateAttribute($value){
    //     return Carbon::parse($value)->format('l, jS M Y');
    // }

    // public function getEndDateAttribute($value){
    //     return Carbon::parse($value)->format('d F, Y');
    // }

    // public function getStartTimeAttribute($value){
    //     return Carbon::parse($value)->format('h:i A');
    // }

    // public function getEndTimeAttribute($value){
    //     return Carbon::parse($value)->format('h:i A');
    // }

    public function elcom(){
        return $this->hasOne(Elcom::class, 'id','elcom_id');
    }

    // public function faculty(){
    //     return $this->hasOne(Faculty::class, 'id','faculty_id');
    // }
}
