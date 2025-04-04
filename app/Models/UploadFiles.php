<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class UploadFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'document_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'file_for'
    ];

    public function user()
    {
        return $this->belongsTo(Student::class);
    }
}
