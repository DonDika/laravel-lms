<?php

namespace App\Http\Controllers;

use App\Models\Course;
use CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    // query tanpa service & repository
    // public function index()
    // {
    //     $coursesByCategory = Course::with('category')
    //         ->latest()
    //         ->get()
    //         ->groupBy(function($course){
    //             return $course->category()->name ?? 'Uncategorized';
    //         });
    //     return view('courses.index', compact('coursesByCategory'));
    // }

    public function index()
    {
        $coursesByCategory = $this->courseService->getCoursesGroupedByCategory();
        return view('courses.index', compact('coursesByCategory'));
    }


    public function details(Course $course) 
    {
        $course->load([
            'category',
            'benefits',
            'courseSections.sectionContents'
        ]);

        return view('courses.details', compact('course'));
    }


    public function join(Course $course)
    {
        $studentName = $this->courseService->enrollUser($course);
        $firstSectionAndContent = $this->courseService->getFirstSectionAndContent($course);
    
        return view('courses.success_joined', array_merge(
            compact('course','studentName'), $firstSectionAndContent
        ));
    }

    public function learning(Course $course, $contentSectionId, $sectionContenId)
    {
        $learningData = $this->courseService->getLearningData($course, $contentSectionId, $sectionContenId);
        
        return view('courses.learning',compact('learningData'));
    }


    public function learningFinished(Course $course)
    {
        return view('courses.learning_finished', compact('course'));
    }


    // public function searchCourses(Request $request)
    // {
    //     $request->validate([
    //         'search' => 'required|string'
    //     ]);

    //     $keyword = $request->search;
    //     $course = Course::where('name', 'like', "%{$keyword}%")
    //         ->orWhere('about', 'like', "%{$keyword}%")
    //         ->get();

    //     return view('courses.search', compact('keyword', 'course'));
    // }


    public function searchCourses(Request $request) 
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        $keyword = $request->search;
        $course = $this->courseService->searchCourses($keyword);

        return view('courses.search', compact('keywword','course'));
    }





}
