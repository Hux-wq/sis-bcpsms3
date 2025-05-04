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
        'student_name',
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

public function getReadableTypeAttribute()
{
    $types = [
        'application/pdf' => 'PDF ',
        'application/docx' => 'Word ',
        'application/doc' => 'Word ',
        'application/jpg' => 'Image/jpg ',
        'application/png' => 'Image/png ',
        'application/txt' => 'Text ',
    ];

    return $types[strtolower($this->file_type)] ?? strtoupper($this->file_type) . ' File';
}
}