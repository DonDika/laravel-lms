<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'thumbnail',
        'about',
        'is_popular',
        'category_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    // satu course bisa banyak benefit
    public function benefits() 
    {
        return $this->hasMany(CourseBenefit::class);
    }

    public function courseSections()
    {
        return $this->hasMany(CourseSection::class, 'course_id');
    }

    //course_id digunakan untuk memperjelas pivot table (many-to-many) agar id tidak salah
    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class, 'course_id');
    }

    public function courseMentors()
    {
        return $this->hasMany(CourseMentor::class, 'course_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //menghitung kira-kira ada berapa section
    public function getContentCountAttribute()
    {
        return $this->courseSections->sum(function ($section){
            return $section->sectionContents->count();
        });
    }
}
