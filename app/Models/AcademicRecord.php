<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AcademicRecord extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'section_id','course_id','year','year_level','semester','cumulative_gpa'];   


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class);
    }
}
