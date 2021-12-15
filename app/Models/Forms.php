<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    use HasFactory;

    public function position(){
        return $this->hasOne(Posts::class, 'id','post_id');
    }
}
