<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentSchoolInfo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'age',
        'gender',
        'birthdate',
        'religion',
        'pace_of_birth',
        'current_address',
        'email_address',
        'contact_number', 
        'enrollment_status',
    ];

    public function studentSchoolInfo()
    {
        return   $this->hasOne(StudentSchoolInfo::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academicRecords()
    {
        return $this->hasMany(AcademicRecord::class);
    }
}
