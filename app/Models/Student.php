<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [ 
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
        'enrollment_date',
        'enrollment_for',
        'desired_major',
        'enrollment_status',
    ];
}
