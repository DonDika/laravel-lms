<?php  

namespace App\Repositories;

use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface
{

    public function searchByKeyword(string $keyword)
    {   
        return Course::where('name', 'like', "%{$keyword}%")
            ->orWhere('about', 'like', "%{$keyword}%") 
            ->get();
    }

    public function getAllWithCategory()
    {
        return Course::with('category')->latest()->get();
    }

}
