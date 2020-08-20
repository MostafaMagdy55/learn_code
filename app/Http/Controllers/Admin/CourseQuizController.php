<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseQuizController extends Controller
{


    public function create(Course $course)
    {
        return view('admin.courses.createquiz' ,compact('course'));
    }

}
