<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserNameInfo extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'middle_name','last_name','suffix_name','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
