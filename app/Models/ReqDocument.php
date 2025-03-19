<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqDocument extends Model
{
    use HasFactory;

    protected $fillable = ['docu_name','status'];
}
