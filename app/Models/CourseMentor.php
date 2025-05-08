<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseMentor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'is_active',
        'about'
    ];

    //untuk akses nama mentor di tabel User
    public function mentor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course() 
    {
        return $this->belongsTo(Course::class, 'course_id');
    }




}
