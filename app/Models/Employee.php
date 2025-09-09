<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Fields that can be mass assigned
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password',
        'phone', 
        'department_id', 
        'position_id'
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}


