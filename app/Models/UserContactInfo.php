<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserContactInfo extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'email_address','facebook','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
