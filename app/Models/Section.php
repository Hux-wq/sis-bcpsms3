<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [ 'section','adviser','year','semester', 'specialization','created_by','department_id' ];

    public function students()
    {
        return $this->hasMany(Student::class, 'program_id', 'id');
    }

    public function adviserUser()
    {
        return $this->belongsTo(User::class, 'adviser');
    }
}
