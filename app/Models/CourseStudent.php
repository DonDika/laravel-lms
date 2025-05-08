<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class CourseStudent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'is_active'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course() 
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
