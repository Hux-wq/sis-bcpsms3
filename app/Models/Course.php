<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_code', 'title','description','department_id','program_id','is_active','credits', 'level'];   

    public function getStatusTextAttribute()
    {
        return $this->is_active == 1 ? 'Active' : 'Not Active';
    }
}
