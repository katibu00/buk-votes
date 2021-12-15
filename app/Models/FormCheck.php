<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormCheck extends Model
{
    use HasFactory;

    public function position(){
        return $this->hasOne(Posts::class, 'id','post_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function election(){
        return $this->hasOne(Election::class, 'id','election_id');
    }

    public function post(){
        return $this->hasOne(Posts::class, 'id','post_id');
    }
    public function receive(){
        return $this->hasOne(User::class, 'id','payment_id');
    }

}
