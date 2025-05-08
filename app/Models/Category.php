<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'slug'
    ];

    //generate slug
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //orm, relasi one-to-many, yg artinya satu category bisa memiliki banyak course 
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


}
