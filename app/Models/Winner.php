<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    public function election(){
        return $this->hasOne(Election::class, 'id','election_id');
    }

    public function post(){
        return $this->hasOne(Posts::class, 'id','post_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id','contestant_id');
    }
}
