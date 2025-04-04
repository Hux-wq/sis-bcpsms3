<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserNameInfo;
use App\Models\UserBasicInfo;
use App\Models\UserContactInfo;
use App\Models\UserSchoolInfo;
use App\Models\AcademicRecord;

use App\Models\Student;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'linking_id',
        'name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    



    public function isAdmin()
    {
        return $this->acc_type == 'admin';
    }

    public function isStudent()
    {
        return $this->acc_type == 'student';
    }




    public function UserNameInfo()
    {
        return $this->hasOne(UserNameInfo::class);
    }

    public function UserBasicInfo()
    {
        return $this->hasOne(UserBasicInfo::class);
    }

    public function UserContactInfo()
    {
        return $this->hasOne(UserContactInfo::class);
    }

    public function UserSchoolInfo()
    {
        return $this->hasOne(UserSchoolInfo::class);
    }

    public function AcadRecordsInfo()
    {
        return $this->hasMany(AcademicRecord::class);
    }
}
