<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class StudentSchoolInfo extends Model
{
    use HasFactory;

    protected $fillable = ['year_level','department_code'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
