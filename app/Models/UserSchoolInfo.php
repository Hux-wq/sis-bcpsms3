<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserSchoolInfo extends Model
{
    use HasFactory;

    protected $fillable = ['position','student_id','section_id','schoolastic_type','current_year', 'current_year_level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
