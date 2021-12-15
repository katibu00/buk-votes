<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDepartment extends Model
{
    use HasFactory;

    public function faculty()
    {

        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
