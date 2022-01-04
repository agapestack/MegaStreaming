<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    use HasFactory;
    protected $table = "profile_pictures";
    protected $fillable = [
        'user_id',
        'path',
        'disk'
    ];
}
